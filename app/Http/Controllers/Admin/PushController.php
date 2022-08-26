<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PushNotification;
use App\Models\User;
use App\Services\Firebase\SendMultiple;
use App\Services\Firebase\SendMultipleAll;
use App\Services\Firebase\SendSingle;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class PushController extends Controller
{
    public function index()
    {
        $push = PushNotification::latest()->get();

        $receivers = [];

        foreach($push as $p){
            $receivers[] = json_decode($p->receivers);
        }

        $users = [];

        foreach($receivers as $key => $token){

            if ($token[0] == 'all') {
                $users[] = ['name' => 'all'];
            }else{
                $users[] = User::whereIn('device_token', $token)->get();
            }
        }

        return view('admin.notifications.push.index')
            ->withPush($push)
            ->withUsers($users);
    }

    public function create()
    {
         $users = User::whereNotNull('device_token')->get();

        return view('admin.notifications.push.create')->withUsers($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'receiver' => 'required'
        ]);

        $check = User::whereNotNull('device_token')->get();

        if(count($check) == 0){
             return redirect(route('admin.notifications.push.index'))->withErrors('Maaf untuk saat ini tidak dapat mengirim notifikasi karena tidak ada device yang terdaftar');
        }

        try {

            $push = PushNotification::create([
                'title' => $request->title,
                'text' => $request->text,
                'receivers' => json_encode($request->receiver),
            ]);

            $tokens = [];

            $notification = [
                'title' => $request->title,
                'body' => $request->text,
                'image' => url('storage/misc/capsuleinnlogo.png'),
            ];

            if(count($request->receiver) > 1){
                SendMultiple::send($request);
            } elseif($request->receiver[0] == 'all'){
                SendMultipleAll::send($request);
            }else{
                (new SendSingle)->send($request);
            }

            return redirect(route('admin.notifications.push.index'))->withSuccess('Berhasil Mengirim Push Notifikasi');
            
        } catch (\Exception $e) {
            return redirect(route('admin.notifications.push.index'))->withErrors('Gagal Mengirim Push Notifikasi, Error : ' . $e->getMessage());
        }

    }

    public function destroy(Request $request)
    {
        $push = PushNotification::find($request->id);

        $push->delete();

        return redirect(route('admin.notifications.push.index'))->withSuccess('Berhasil Hapus Daya Push Notifikasi');
    }
}
