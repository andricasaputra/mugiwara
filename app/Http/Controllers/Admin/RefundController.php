<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\User;
use App\Notifications\RefundStatusNotification;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        return view('admin.refund.index')->withRefunds(Refund::with(['user', 'reason'])->get());
    }

    public function show(Refund $refund)
    {
        return view('admin.refund.show')->withRefund($refund->load(['reason', 'order', 'payment', 'user']));
    }

    public function actionPage(Refund $refund)
    {
        return view('admin.refund.action')->withRefund($refund);
    }

    public function action(Request $request, Refund $refund)
    {

        $status = $request->status == 'tolak' ? 'Di Tolak' : 'Di Setujui';

        $refund->update([
            'status' => $status,
            'refund_action_date' => now()
        ]);

        $admin = User::admin()->first();

        if($request->status == 'tolak'){
            $message = 'Yah Maaf, Pengajuan refund anda ditolak, silahkan hubungi pusat bantuan untuk informasi lebih lanjut';
        } else {
            $message = 'Permohonan refund anda disetujui, mohon menunggu, pengajuan refund anda akan kami proses';
        }

        $notification_user = new RefundStatusNotification(
            $refund,
            $message
        );

        $notification_admin = new RefundStatusNotification(
            $refund,
            'Pengajuan refund ' . $status
        );

        $refund->user->notify($notification_user);

        $admin->notify($notification_admin); 

         return redirect(route('admin.refund.index'))->withSuccess('Berhasil Ubah Data Refund');
    }
}
