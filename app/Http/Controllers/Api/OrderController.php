<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PaymentServiceInterface;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Xendit\Xendit;

class OrderController extends Controller
{
    public function __construct()
    {
         Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
    }

    public function pay(Request $request)
    {
        $services = app()->make(PaymentServiceInterface::class);
        $payments = $services->pay($request);

        dd($services);

        $order = new OrderRepository();
        $order->create($payments);
    }
}
