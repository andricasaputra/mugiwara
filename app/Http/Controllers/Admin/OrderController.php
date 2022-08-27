<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Office;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;
use App\Notifications\RoomReviewsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->with(['payment', 'user', 'accomodation', 'room.type', 'refund'])->get();

        return view('admin.order.index')->withOrders($orders);
    }

    public function detail(Order $order)
    {
        $order = $order->load(['payment.payable', 'payment.voucher', 'user', 'accomodation', 'room.type']);

        return view('admin.order.detail')->withOrder($order);
    }

    public function checkinPage(Order $order)
    {
        $order = $order->load(['payment.payable', 'payment.voucher', 'user', 'accomodation', 'room.type']);

        $rooms = Room::where('accomodation_id', $order->accomodation_id)->where('type_id', $order->room?->type?->id)->where('status', 'available')->get();

        return view('admin.order.checkin')
            ->withOrder($order)
            ->withRooms($rooms);
    }

    public function checkin(Request $request)
    {
        DB::beginTransaction();

        try {

            $order = Order::findOrFail($request->id);

            $order->update([
                'order_status' => 'stayed'
            ]);

            $order->room()->update([
                'status' => 'stayed',
                'stayed_untill' => \Carbon\Carbon::parse($order->check_in_date)->addDays($order->stay_day)
            ]);

            DB::commit();

            return redirect(route('admin.orders.index'))->withSuccess('Berhasil checkin tamu ruangan nomor ' . $order->room->room_number);
            
        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('admin.orders.index'))->withErrors('Gagal checkin ruangan, error ' . $e->getMessage());
            
        }
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

            $user = User::where('id', $order->user?->id)->first();
            $customer = Customer::where('id', $order->user?->id)->first();

            if($user){
                $user->notify(new RoomReviewsNotification($order));
            }

            if($customer){
                $customer->notify(new RoomReviewsNotification($order));
            }

            DB::commit();

            return redirect(route('admin.orders.index'))->withSuccess('Berhasil checkout tamu ruangan nomor ' . $room->room_number);
            
        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('admin.orders.index'))->withErrors('Gagal checkout ruangan, error ' . $e->getMessage());
        }

        
    }

    public function edit(Order $order)
    {
        if($order->order_status == 'completed' || $order->refund){
            return redirect(route('admin.orders.index'))->withErrors('Pesanan sudah tidak dapat diubah');
        }

        $rooms = Room::where('accomodation_id', $order->accomodation_id)->where('type_id', $order->room?->type?->id)->where('status', 'available')->get();

        return view('admin.order.edit')
            ->withOrder($order->load(['accomodation', 'room.type', 'user']))
            ->withRooms($rooms);
    }

    public function update(Request $request, Order $order)
    {
        DB::beginTransaction();

        try {

            $order->fill([
                'booking_code' => $order->booking_code,
                'accomodation_id' => $order->accomodation_id,
                'room_id' => (int) $request->room_id,
                'user_id' => $order->user_id,
                'check_in_date' => $order->check_in_date,
                'check_in_time' => $order->check_in_time,
                'stay_day' => $order->stay_day,
                'normal_price' => $order->normal_price,
                'discount_type' => $order->discount_type,
                'discount_percent' => $order->discount_percent,
                'discount_amount' => $order->discount_amount,
                'total_price' => $order->total_price,
                'check_out_date' => $order->check_out_date,
                'order_status' => $order->order_status,
                'total_guest' => $order->total_guest,
            ]);

            $order->save();

            // $room_old = Room::find($request->room_id_old);

            // $room_old->update([
            //     'status' => 'available',
            //     'stayed_untill' => NULL,
            //     'booked_untill' => NULL
            // ]);

            $room = Room::find($request->room_id);

            $room->update([
                'status' => $order->order_status
            ]);

            DB::commit();

            return redirect(route('admin.orders.index'))->withSuccess('Berhasil ubah data pesanan, silahkan lakukan update pada nomor kamar sebelumnya pada halaman manajemen penginapan bagian kamar jika ada perubahan status kamar');
            
            
        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('admin.orders.index'))->withErrors('Gagal ubah data pesanan');
        }

       
    }
}
