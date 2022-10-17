<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CallbackXendit;
use App\Models\Customer;
use App\Models\Office;
use App\Models\Payments\Ewallet;
use App\Models\Payments\VirtualAccount;
use App\Models\User;
use App\Notifications\Admin\AdminPaymentStatusNotification;
use App\Notifications\Payments\PaymentStatusEmailNotification;
use App\Notifications\Payments\PaymentStatusNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class XenditCallbackOvoController extends Controller
{
     public function ovo(Request $request)
    {
        $data = json_encode($request->all());

        $callback = CallbackXendit::create([
            'payload' => $data
        ]);

        $status = json_decode($callback->payload);

        $ewallet = Ewallet::where('ewallet_id', $status?->id)->first();

        $ewallet?->update([
            'payload' => $data
        ]);

        $ewallet?->payment()?->update([
            'status' => $status?->status,
            'amount' => $status?->charge_amount,
        ]);

        if($status?->status == 'FAILED' || $status?->status == 'EXPIRED'){

            $ewallet?->payment?->first()?->order()?->update([
                'order_status' => 'cancel',
                //'check_in_date' => NULL
            ]);

            $update = $ewallet?->payment?->first()?->order?->room()->update([
                'status' => 'available',
                'booked_untill' => NULL,
                'stayed_untill' => NULL
            ]);
        }

        info('Dari Ovo');

        $this->sendNotificationEwallet($ewallet?->payment?->first()?->order, $ewallet?->payment?->first(), $status);
    }

    protected function sendNotificationEwalletFailed($order, $payment, $status)
    {

        if($status?->status == 'SUCCEEDED'){
            $pembayaran = 'Berhasil';
            $message = 'Terimakasih telah melakukan pembayaran. Semoga waktu menginap anda menyenangkan!';
        }elseif($status?->status == 'FAILED'){
            $pembayaran = 'Gagal';
            $message = 'Mohon Maaf Pembayaran Anda Belum Berhasil. Silahkan Lakukan Kembali Pembayaran Dengan Metode Pembayaran Yang Telah Dipilih!';
        }elseif($status?->status == 'EXPIRED' || $status?->status == 'INACTIVE'){
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

        event(new \App\Events\PaymentBroadcastEvent($user_title));

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
