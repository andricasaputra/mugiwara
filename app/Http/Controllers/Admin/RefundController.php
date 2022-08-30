<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Refund;
use App\Models\RefundReason;
use App\Models\User;
use App\Notifications\RefundStatusEmailNotification;
use App\Notifications\RefundStatusNotification;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        return view('admin.refund.index')->withRefunds(Refund::latest()->with(['user', 'reason'])->get());
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

         return redirect(route('admin.refund.index'))->withSuccess('Berhasil Ubah Data Refund');
    }

    public function showReason()
    {
        return view('admin.refund.reason.index')->withReasons(RefundReason::latest()->get());
    }

    public function createReason()
    {
        return view('admin.refund.reason.create');
    }

    public function editReason(RefundReason $reason)
    {
        return view('admin.refund.reason.edit')->withReason($reason);
    }

    public function storeReason(Request $request)
    {
        RefundReason::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect(route('admin.refund.reason.index'))->withSuccess('Berhasil Tambah Data');
    }

    public function updateReason(Request $request, RefundReason $reason)
    {
        $reason->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect(route('admin.refund.reason.index'))->withSuccess('Berhasil Ubah Data');
    }

    public function destroyReason(Request $request)
    {
        $reason = RefundReason::find($request->id);

        $reason->delete();

        return redirect(route('admin.refund.reason.index'))->withSuccess('Berhasil Hapus Data');
    }
}
