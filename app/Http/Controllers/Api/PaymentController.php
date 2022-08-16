<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PaymentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentEwalletRequest;
use App\Http\Requests\PaymentVirtualAccountRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Order;
use App\Models\Room;
use App\Models\Setting;
use App\Notifications\Payments\PaymentStatusNotification;
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

        // if($request->amount != $order?->total_price){
        //     return response()->json([
        //         'message' => 'Amount yang anda masukkan tidak sesuai dengan tagihan'
        //     ], 422);
        // }

        if($request->has('voucher_id') && $request->voucher_id != NULL){

            $user = \App\Models\User::where('id', auth()->id())->first();
            $userVoucherUsed = $user->voucher()->find('voucher_id');

            if(!is_null($userVoucherUsed)){
                return response()->json([
                    'message' => 'voucher sudah pernah digunakan'
                ]); 
            }

           \App\Models\UserVoucher::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'voucher_id' => $request->voucher_id,
                ],
                [
                    'is_used' => 1
                ]

            );
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
        $payment = $this->payment->create($payments, $order, $request);

        return new PaymentResource($payment);
    }

    public function createVirtualAccount(PaymentVirtualAccountRequest $request)
    {
        $order = Order::where('booking_code', $request->booking_code)->first();

        if(! $order){
            return response()->json([
                'message' => 'Order dengan ID "' . $request->booking_code . '" tidak ditemukan.'
            ], 422);
        }

        // if($request->amount != $order?->total_price){
        //     return response()->json([
        //         'message' => 'Amount yang anda masukkan tidak sesuai dengan tagihan'
        //     ], 422);
        // }

       if($request->has('voucher_id') && $request->voucher_id != NULL){

            $user = \App\Models\User::where('id', auth()->id())->first();
            $userVoucherUsed = $user->voucher()->find('voucher_id');

            if(!is_null($userVoucherUsed)){
                return response()->json([
                    'message' => 'voucher sudah pernah digunakan'
                ]); 
            }

           \App\Models\UserVoucher::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'voucher_id' => $request->voucher_id,
                ],
                [
                    'is_used' => 1
                ]

            );
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

        $order = Order::where('booking_code', $request->booking_code)->first();

        if(! $order){
            return response()->json([
                'message' => 'Order dengan ID "' . $request->booking_code . '" tidak ditemukan.'
            ], 422);
        }

        $services = app()->make(PaymentServiceInterface::class);

        $payment = $services->pay($request);

        $payment = $this->payment->updateStatusVirtualAccount($payment['status'], $request);

        if($payment['status'] == 'COMPLETED'){

            $request->user()->notify(new PaymentStatusNotification($order, $payment));

        }

        //Update room status
        $this->updateRoomStatus($order->room_id, $order->stay_day);

        $this->createInvoices($payment->toArray());

        return response()->json(['data' => $payment]);
    }

    public function updateStatusEwallet(Request $request)
    {
        try {

            $request->validate([
                'ewallet_id' => 'required',
                'booking_code' => 'required'
            ]);

            $order = Order::where('booking_code', $request->booking_code)->first();

            if(! $order){
                return response()->json([
                    'message' => 'Order dengan ID "' . $request->booking_code . '" tidak ditemukan.'
                ], 422);
            }

            $payment = \Xendit\EWallets::getEWalletChargeStatus($request->ewallet_id);
            $payment = $this->payment->updateStatusEwallet($payment, $request);

            if($payment->status == 'SUCCEEDED'){

                $request->user()->notify(new PaymentStatusNotification($order, $payment));
            }

            //Update room status
            $this->updateRoomStatus($order->room_id, $order->stay_day);
            
            return response()->json(['data' => $payment]);
            
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error get status, error ' . $e->getMessage()
            ]);
            
        }
    }

    protected function updateRoomStatus($id, $stay_days = 1)
    {
        $room = Room::findOrFail($id);

        $room->update([
            'status' => 'stayed',
            'booked_untill' => null,
            'stayed_untill' => now()->addDays($stay_days)
        ]);
    }

    public function tax()
    {
        $setting = Setting::where('type', 'tax')->latest()->first();

        if($setting->is_active == 1){
            return response()->json([
                'data' => [
                    'is_active' => true,
                    'tax' => $setting->value,
                    'type' => 'percent'
                ]
            ]);

        }

        return response()->json([
            'data' => [
                'is_active' => false
            ]
        ]);
    }

    public function createInvoices($payment)
    {//dd($payment);

        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        $params = ['external_id' => 'va-97cc4371-6b0d-4e1f-9ea6-f9e9f94858bc',
            'payer_email' => 'sample_email@xendit.co',
            'description' => 'Trip to Bali',
            'amount' => 32000,
            'for-user-id' => '5c2323c67d6d305ac433ba20'
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        dd($createInvoice);
    }
}
