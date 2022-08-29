<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Refund;
use App\Models\RefundReason;
use App\Models\User;
use App\Notifications\RefundRequestEmailNotification;
use App\Notifications\RefundRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class RefundController extends Controller
{
    public function confirm(Order $order)
    {   
        return new OrderResource($order->load(['user', 'payment', 'voucher']));
    }

    public function refund(Request $request, Order $order)
    {
        $request->validate([
            'reason' => 'required',
            'detail' => 'required',
        ]);

        if($order->user_id != $request->user()->id){
            return response()->json([
                'message' => 'Pesanan ini bukan milik akun anda, apbila terjadi kesalahan silahkan hubungi admin'
            ], 403);
        }

        if(is_null($order->payment) || $order->payment?->status == 'PENDING'){

            return response()->json([
                'message' => 'Anda belum melakukan pembayaran pada order id ini'
            ], 403);
        }

        $check = Refund::where('user_id', $request->user()->id)->where('order_id', $order->id)->first();

        if($check){
            return response()->json([
                'message' => 'Anda sudah pernah mengajukan refund untuk pesanan ini, mohon untuk menunggu proses refund anda'
            ], 403);
        }

        DB::beginTransaction();

        try {

            $refund = Refund::create([
                'user_id' => $request->user()->id,
                'order_id' => $order->id,
                'payment_id' => $order->payment?->id,
                'status' => 'Diproses',
                'reason_id' => $request->reason,
                'detail' => $request->detail,
                'refund_request_date' => now(),
                'refund_number' => Random::generate(12, 1234567890),
            ]);

            $order = Order::findOrFail($order->id);

            $order->update([
                'order_status' => 'refund'
            ]);

            $admin = User::admin()->first();

            $notification_user = new RefundRequestNotification(
                $refund,
                'Anda telah mengajukan permohonan refund, permohonan anda akan segera kami proses'
            );

            $notification_admin = new RefundRequestNotification(
                $refund,
                'Terdapat pengajuan refund'
            );

            $customer = Customer::find($request->user()->id);
            $user = User::find($request->user()->id);

            $user?->notify($notification_user);
            $customer?->notify($notification_user);

            $user?->notify(
                new RefundRequestEmailNotification(
                    $refund,
                    'Anda telah mengajukan permohonan refund, permohonan anda akan segera kami proses'
                )
            );

            $admin->notify($notification_admin); 

            DB::commit();

            return response()->json([
                'data' => $refund->load(['reason', 'payment']),
                'message' => 'Permohonan refund sedang diproses'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function reason()
    {
        return response()->json([
            'data' => RefundReason::all()
        ]);
    }

    public function status(Refund $refund)
    {
        return response()->json([
            'data' => $refund->load('reason')
        ]);
    }
}
