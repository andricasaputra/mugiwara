<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Office;
use App\Models\Order;
use App\Models\User;
use App\Notifications\RoomReviewsNotification;
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
        $order = $order->load(['payment.payable', 'payment.voucher', 'user', 'accomodation', 'room.type']);

        return view('admin.order.detail')->withOrder($order);
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

            $admin = User::where('id', 2)->first();

            $offices = Office::where('accomodation_id', $order->accomodation?->id)->get();

            $customer = Customer::where('id', $order->user?->id)->first();

            if ($offices) {
                foreach($offices as $office){
                    if($office->user){
                        $office->user?->notify(new RoomReviewsNotification($order));
                    }
                }
            }

            if($customer){
                $customer->notify(new RoomReviewsNotification($order));
            }

            $admin->notify(new RoomReviewsNotification($order));

            DB::commit();

            return redirect(route('admin.order.index'))->withSuccess('Berhasil checkout tamu ruangan nomor ' . $room->room_number);
            
        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('admin.order.index'))->withErrors('Gagal checkout ruangan, error ' . $e->getMessage());
        }

        
    }
}
