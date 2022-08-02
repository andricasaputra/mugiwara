<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Refund;
use App\Models\RefundReason;
use Illuminate\Http\Request;

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

        if(is_null($order->payment) || $order->payment?->status == 'PENDING'){

            return response()->json([
                'message' => 'Anda belum melakukan pembayaran pada order id ini'
            ], 403);
        }

        $refund = Refund::create([
            'user_id' => $request->user()->id,
            'order_id' => $order->id,
            'payment_id' => $order->payment?->id,
            'status' => 'Diproses',
            'reason_id' => $request->reason,
            'detail' => $request->detail,
            'refund_date' => NULL
        ]);

        return response()->json([
            'data' => $refund->load('reason'),
            'message' => 'Permohonan refund sedang diproses'
        ]);
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
