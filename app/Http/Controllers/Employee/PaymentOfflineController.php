<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\OrderOffline;
use App\Models\Setting;
use Illuminate\Http\Request;

class PaymentOfflineController extends Controller
{
    public function store(Request $request)
    {
        $order = OrderOffline::findOrFail($request->order_id);

        $tax = Setting::where('type', 'tax')->latest()->first();

        if ($tax && $tax->is_active == 1) {
            $tax_amount = ($tax->value / 100) * $order->normal_price;
        } else {
            $tax_amount = 0;
        }

        if($order->discount_amount != null){

            if($order->discount_type == 'percent'){

                $discount = $order->normal_price * ($order->discount_amount / 100);

            } elseif($order->discount_type == 'flat'){

                $discount = $order->discount_amount;

            } else {

                $discount = 0;
            }

        }

       try {

         $order->payment()->create([

            'booking_code' => $order->booking_code,
            'user_id' => null,
            'payment_id' => null,
            'voucher_id' => NULL,
            'currency' => null,
            'amount' => $order->total_price,
            'discount_type' => $order->discount_type ?? NULL,
            'discount_amount' => (int) $discount,
            'tax' => $tax_amount,
            'status' => 'PAYED',
        
        ]);

        return redirect(route('employee.order.offline.index'))->withSuccess('Pesanan Kamar Telah Lunas, segera lakukan Check In');
           
       } catch (\Exception $e) {

        return redirect(route('employee.order.offline.index'))->withErrors('Gagal Tambah Pembayaran, Error : ' . $e->getMessage());
           
       }
    }
}
