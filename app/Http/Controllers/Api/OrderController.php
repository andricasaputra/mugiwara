<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserOrderResource;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

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
        return new UserOrderResource($order->load(['payment.voucher', 'room.images', 'room' => function($query){
            $query->withCount('reviews')->withAvg('reviews', 'rating');
        }]));
    }

}
