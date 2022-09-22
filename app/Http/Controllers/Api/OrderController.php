<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserOrderResource;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(protected OrderRepository $order)
    {
    }

    public function create(OrderRequest $request)
    {
        try {

            return new OrderResource($this->order->create($request));
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->get();

        return response()->json([
            'data' => $orders
        ]);
    }

    public function show(Order $order)
    {
        return new UserOrderResource($order->load(['refund', 'payment.voucher', 'payment.payable', 'accomodation.room', 'room' => function($query){
            $query->withCount('reviews')->withAvg('reviews', 'rating');
        }]));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required'
        ]);

        DB::beginTransaction();

        try {

            $order = Order::findOrFail($request->order_id);

            return $order->payment?->payable;

            $order->update([
                'order_status' => 'cancel'
            ]);

            $order->payment()->update([
                'status' => 'EXPIRED'
            ]);

            $order->room()->update([
                'status' => 'available',
                'booked_untill' => NULL,
                'stayed_untill' => NULL
            ]);

            DB::commit();

            return new UserOrderResource($order->load(['refund', 'payment.voucher', 'payment.payable', 'accomodation.room', 'room' => function($query){
                $query->withCount('reviews')->withAvg('reviews', 'rating');
            }]));
            
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'message' => 'Gagal update data, Error : ' . $e->getMessage()
            ]);
        }
    }

    public function ticket(Order $order)
    {
        return response()->json([
            'data' => $order->load(['accomodation:id,name', 'user:id,name,mobile_number', 'payment.voucher'])
        ]);
    }

}
