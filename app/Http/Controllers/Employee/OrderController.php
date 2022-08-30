<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Room;
use App\Notifications\RoomReviewsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->with(['payment', 'user', 'accomodation', 'room.type', 'refund'])->where('accomodation_id', auth()->user()->office?->office?->accomodation_id)->get();

        return view('employee.order.index')->withOrders($orders);
    }

    public function detail(Order $order)
    {
        if($order->accomodation_id != auth()->user()->office?->office?->accomodation_id){
            abort(403);
        }

       $order = $order->load(['payment.payable', 'payment.voucher', 'user', 'accomodation', 'room.type']);

        return view('employee.order.detail')->withOrder($order);
    }

    public function checkinPage(Order $order)
    {
        $order = $order->load(['payment.payable', 'payment.voucher', 'user', 'accomodation', 'room.type']);

        $rooms = Room::where('accomodation_id', $order->accomodation_id)->where('type_id', $order->room?->type?->id)->where('status', 'available')->get();

        return view('employee.order.checkin')
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

            return redirect(route('employee.order.index'))->withSuccess('Berhasil checkin tamu ruangan nomor ' . $order->room->room_number);
            
        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('employee.order.index'))->withErrors('Gagal checkin ruangan, error ' . $e->getMessage());
            
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

            return redirect(route('employee.order.index'))->withSuccess('Berhasil checkout tamu ruangan nomor ' . $room->room_number);
            
        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('employee.order.index'))->withErrors('Gagal checkout ruangan, error ' . $e->getMessage());
        }

        
    }
}
