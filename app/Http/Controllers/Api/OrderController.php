<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserOrderResource;
use App\Models\Customer;
use App\Models\Office;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Admin\AdminPaymentStatusNotification;
use App\Notifications\Payments\PaymentStatusEmailNotification;
use App\Notifications\Payments\PaymentStatusNotification;
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

           if($order->payment?->payable?->channel_code == "ID_DANA"){
                $this->sendNotificationEwalletFailed($order, $order?->payment, 'EXPIRED');
           }

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

    protected function sendNotificationEwalletFailed($order, $payment, $status)
    {
        if($status == 'FAILED'){
            $pembayaran = 'Gagal';
            $message = 'Mohon Maaf Pembayaran Anda Belum Berhasil. Silahkan Lakukan Kembali Pembayaran Dengan Metode Pembayaran Yang Telah Dipilih!';
        }elseif($status == 'EXPIRED' || $status == 'INACTIVE'){
            $pembayaran = 'Expired';
            $message = 'Mohon Maaf Pembayaran Anda Sudah Kadaluarsa.';
        }else{
            $pembayaran = 'Pending';
            $message = 'Segera Lakukan Pembayaran Untuk Segera Menikmati Fasilitas Hotel Kami.';
        }

        $customer_title = 'Pembayaran ' . $pembayaran . '!';
        $customer_message = $message;

        $customer = Customer::find($payment?->user?->id);
        $user = User::find($payment?->user?->id);

        $user?->notify(
            new PaymentStatusEmailNotification(
                $order, $payment, $customer_title, $customer_message
            )
        );

        $user?->notify(
            new PaymentStatusNotification(
                $order, $payment, $customer_title, $customer_message
            )
        );

        $customer?->notify(
            new PaymentStatusNotification(
                $order, $payment, $customer_title, $customer_message
            )
        );

        $user_title = 'Terdapat Pembayaran ' . $pembayaran;
        $user_message = 'Pembayaran dengan Order ID ' . $order?->id . ' ' . $pembayaran  . ' kunjungi halaman keuangan untuk detail lebih lanjut.';

        $admin = User::admin()->first();

        $office = Office::with('users')->where('accomodation_id',  $order?->accomodation_id)->first();

        // Notify admin and employee
        $admin->notify(
            new AdminPaymentStatusNotification(
                $order, $payment, $user_title, $user_message
            )
        );
        
        if(!is_null($office) && count($office?->users) > 0){

            foreach($office->users as $employee){
                $employee->user?->notify(
                    new AdminPaymentStatusNotification(
                        $order, $payment, $user_title, $user_message
                    )
                );
            }
        }
    }

}
