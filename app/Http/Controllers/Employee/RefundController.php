<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Refund;
use App\Models\User;
use App\Notifications\RefundStatusEmailNotification;
use App\Notifications\RefundStatusNotification;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        return view('employee.refund.index')->withRefunds(Refund::latest()->with(['user', 'reason'])->get());
    }

    public function show(Refund $refund)
    {
        return view('employee.refund.show')->withRefund($refund->load(['reason', 'order', 'payment', 'user']));
    }

    public function actionPage(Refund $refund)
    {
        return view('employee.refund.action')->withRefund($refund);
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

        $customer = Customer::find($refund->user?->id);
        $user = User::find($refund->user?->id);

        $user?->notify($notification_user);
        $customer?->notify($notification_user);

        $user?->notify(
            new RefundStatusEmailNotification(
                $refund,
                $message
            )
        );

        $admin->notify($notification_admin); 
        auth()->user()->notify($notification_admin); 

         return redirect(route('employee.refund.index'))->withSuccess('Berhasil Ubah Data Refund');
    }
}
