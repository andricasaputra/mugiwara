<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['payment', 'user', 'accomodation', 'room.type', 'refund'])->get();

        return view('admin.order.index')->withOrders($orders);
    }

    public function detail(Order $order)
    {
        $orders = Order::with(['payment', 'user', 'accomodation', 'room.type'])->get();

        return view('admin.order.detail')->withOrders($orders);
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {

            $order = Order::findOrFail($request->order_id);

            $room = $order->room;

            $order->update([
                'check_out_date' => now(),
                'order_status' => 'completed'
            ]);

            $room->update([
                'status' => 'available',
                'stayed_untill' => NULL,
                'booked_untill' => NULL,
            ]);

            //dd($room);

            DB::commit();

            return redirect(route('admin.order.index'))->withSuccess('Berhasil checkout tamu ruangan nomor ' . $room->room_number);
            
        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('admin.order.index'))->withErrors('Gagal checkout ruangan, error ' . $e->getMessage());
        }

        
    }
}
