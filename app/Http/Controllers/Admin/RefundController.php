<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
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

         return redirect(route('admin.refund.index'))->withSuccess('Berhasil Ubah Data Refund');
    }
}
