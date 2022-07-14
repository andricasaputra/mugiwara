<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PaymentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentEwalletRequest;
use App\Http\Requests\PaymentVirtualAccountRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Order;
use App\Repositories\PaymentsRepository;
use App\Repositories\PaymentsType;
use Illuminate\Http\Request;
use Xendit\Xendit;

class PaymentController extends Controller
{
    public function __construct(protected PaymentsRepository $payment)
    {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
    }

    public function lists()
    {
        $lists = \Xendit\PaymentChannels::list();
        $lists = collect($lists)->filter(fn($list) => $list['is_enabled']);

        $newList = $this->payment->lists($lists);

        return response()->json(['data' => $newList]);
    }

    public function status()
    {
        return response()->json(request()->all());
    }

    public function createEwallet(PaymentEwalletRequest $request)
    {
        $order = Order::where('booking_code', $request->booking_code)->first();

        if(! $order){
            return response()->json([
                'message' => 'Order dengan ID "' . $request->booking_code . '" tidak ditemukan.'
            ], 422);
        }

        if($request->amount != $order?->total_price){
            return response()->json([
                'message' => 'Amount yang anda masukkan tidak sesuai dengan tagihan'
            ], 422);
        }


        $paymentOrder = $order->payment?->status;

        if(!is_null($paymentOrder) && $paymentOrder != 'PENDING'){
            return response()->json([
                'message' => 'Status pembayarn telah ' .$paymentOrder. ' pada kode booking ini'
            ], 422);
        }

        $services = app()->make(PaymentServiceInterface::class);

        // create payment charge to xendit
        $payments = $services->createPayment($request);

        // create payment to databse
        $create = $this->payment->create($payments, $order, $request);

        return new PaymentResource($create);
    }

    public function createVirtualAccount(PaymentVirtualAccountRequest $request)
    {
        $order = Order::where('booking_code', $request->booking_code)->first();

        if(! $order){
            return response()->json([
                'message' => 'Order dengan ID "' . $request->booking_code . '" tidak ditemukan.'
            ], 422);
        }

        if($request->amount != $order?->total_price){
            return response()->json([
                'message' => 'Amount yang anda masukkan tidak sesuai dengan tagihan'
            ], 422);
        }

        $paymentOrder = $order->payment?->status;

        if(!is_null($paymentOrder) && $paymentOrder != 'PENDING'){
            return response()->json([
                'message' => 'Status pembayarn telah ' .$paymentOrder. ' pada kode booking ini'
            ], 422);
        }

        $services = app()->make(PaymentServiceInterface::class);

         // create payment charge to xendit
        $payments = $services->createPayment($request);

        // create payment to databse
        $create = $this->payment->create($payments, $order, $request);

        return new PaymentResource($create);
    }

    public function virtualAccountPay(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'external_id' => 'required',
            'channel_category' => 'required',
            'booking_code' => 'required'
        ]);

        $services = app()->make(PaymentServiceInterface::class);

        $payment = $services->pay($request);

        $this->payment->updateStatusVirtualAccount($payment['status'], $request);

        return response()->json(['data' => $payment]);
    }

    public function updateStatusEwallet(Request $request)
    {
        try {

            $request->validate([
                'ewallet_id' => 'required',
                'booking_code' => 'required'
            ]);

            $payment = \Xendit\EWallets::getEWalletChargeStatus($request->ewallet_id);
            $this->payment->updateStatusEwallet($payment, $request);
            
            return response()->json(['data' => $payment]);
            
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error get status, error ' . $e->getMessage()
            ]);
            
        }
    }
}
