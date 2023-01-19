<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\OrderOffline;
use App\Models\Room;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class OrderOfflineController extends Controller
{
    public function index()
    {
        $orders = OrderOffline::with(['payment', 'room', 'accomodation'])->latest()->get();

        return view('employee.order_offline.index')->withOrders($orders);
    }

    public function create()
    {
        $accomodation = auth()->user()->office?->office;
        $rooms = Room::where('accomodation_id', $accomodation->id)->get();
        $tax = Setting::where('type', 'tax')->where('is_active', 1)->latest()->first();

        return view('employee.order_offline.create')->withAccomodation($accomodation)->withRooms($rooms)->withTax($tax);
    }

    public function edit($id)
    {
        return view('employee.order_offline.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'check_in_date' => 'required',
            'stay_day' => 'required',
            'total_guest' => 'required',
        ]);

        $room = Room::findOrFail($request->room_id);

        if($request->total_guest > $room->max_guest){

             return back()->withErrors('Jumlah Tamnu Melebihi Kapasitas Kamar!');
        }

        DB::beginTransaction();

        try {

            OrderOffline::create([
                'booking_code' => 'capsuleinn-offline-' . Uuid::uuid4()->toString(),
                'accomodation_id' => $request->accomodation_id,
                'room_id' => $request->room_id,
                'user_id' => null,
                'check_in_date' => $request->check_in_date,
                'check_in_time' => now(),
                'stay_day' => $request->stay_day,
                'total_guest' => $request->total_guest,
                'normal_price' => $request->normal_price,
                'discount_type' => $request->discount_type,
                'discount_percent' => $request->discount_amount,
                'discount_amount' => $request->discount_amount,
                'total_price' => $request->total_amount,
                'check_out_date' => Carbon::parse($request->check_in_date)->addDays($request->stay_day),
                'order_status' => 'booked',
            ]);

            $room = Room::findOrFail($request->room_id);

            $room->status = 'booked';
            $room->booked_untill = now()->addDays(1);
            $room->total_order = $room->order()->count() + 1;
            $room->save();

            DB::commit();

            return redirect(route('employee.order.offline.index'))->withSuccess('Berhasil Tambah Order');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('employee.order.offline.index'))->withErrors('Gagal Tambah Order, Error :' . $e->getMessage());
            
        }

        
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        //
    }

    public function detail(OrderOffline $order)
    {
        $order = $order->load(['payment', 'accomodation', 'room.type']);

        return view('employee.order_offline.detail')->withOrder($order);
    }

    public function checkIn(Request $request)
    {
        DB::beginTransaction();

        try {

            $order = OrderOffline::findOrFail($request->order_id);

            $order->update([
                'order_status' => 'stayed'
            ]);

            $order->room()->update([
                'status' => 'stayed',
                'stayed_untill' => \Carbon\Carbon::parse($order->check_in_date)->addDays($order->stay_day)
            ]);

            DB::commit();

            return redirect(route('employee.order.offline.index'))->withSuccess('Berhasil checkin tamu ruangan nomor ' . $order->room?->room_number);

        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('employee.order.offline.index'))->withErrors('Gagal checkin ruangan, error ' . $e->getMessage());

        }
    }

    public function checkOut(Request $request)
    {
        DB::beginTransaction();

        try {

            $order = OrderOffline::findOrFail($request->order_id);

            $room = $order?->room;

            $order->update([
                'check_out_date' => now(),
                'order_status' => 'completed'
            ]);

            $room->update([
                'status' => 'available',
                'stayed_untill' => NULL,
                'booked_untill' => NULL,
            ]);

            DB::commit();

            return redirect(route('employee.order.offline.index'))->withSuccess('Berhasil checkout tamu ruangan nomor ' . $room->room_number);

        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('employee.order.offline.index'))->withErrors('Gagal checkout ruangan, error ' . $e->getMessage());
        }
    }

    public function roomData(Request $request)
    {
        $room = Room::findOrFail($request->room_id);

        return response()->json($room);
    }

}
