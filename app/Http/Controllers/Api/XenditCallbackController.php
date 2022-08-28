<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CallbackXendit;
use App\Models\Office;
use App\Models\Payments\Ewallet;
use App\Models\Payments\VirtualAccount;
use App\Models\User;
use App\Notifications\Admin\AdminPaymentStatusNotification;
use App\Notifications\Payments\PaymentStatusNotification;
use Illuminate\Http\Request;

class XenditCallbackController extends Controller
{
    public function ewallet(Request $request)
    {
        $data = json_encode($request->all());

        $callback = CallbackXendit::create([
            'payload' => $data
        ]);

        $status = json_decode($callback->payload);

        $ewallet = Ewallet::where('ewallet_id', $status?->data?->id)->first();

        $ewallet?->update([
            'payload' => $data
        ]);

        $ewallet?->payment()?->update([
            'status' => $status?->data?->status,
            'amount' => $status?->data?->charge_amount,
        ]);

        $this->sendNotification($ewallet?->payment?->order, $ewallet?->payment, $status);
    }

    public function virtualAccount(Request $request)
    {

        $data = json_encode($request->all());
        \Log::info($data);

        $callback = CallbackXendit::create([
            'payload' => $data
        ]);

        $status = json_decode($callback->payload);

        $va = VirtualAccount::where('external_id', $status->external_id)->first();

        if(! $va){
            throw new \Exception("Pembayaran tidak ditemukan", 1);
            
        }

        $va->update([
            'payload' => $data
        ]);

        $va->payment()->update(['status' => $status]);

        $this->sendNotification($va?->payment?->order, $va?->payment, $status);
    }

    protected function sendNotification($order, $payment, $status)
    {

        if($status?->data?->status == 'SUCCEEDED' || $status?->data?->status == 'COMPLETED'){
            $pembayaran = 'Berhasil';
            $message = 'Terimakasih telah melakukan pembayaran. Semoga waktu menginap anda menyenangkan!';
        }elseif($status?->data?->status == 'FAILED'){
            $pembayaran = 'Gagal';
            $message = 'Mohon Maaf Pembayaran Anda Belum Berhasil. Silahkan Lakukan Kembali Pembayaran Dengan Metode Pembayaran Yang Telah Dipilih!';
        }elseif($status?->data?->status == 'EXPIRED'){
            $pembayaran = 'Expired';
            $message = 'Mohon Maaf Pembayaran Anda Kadaluarsa.';
        }else{
            $pembayaran = 'Pending';
            $message = 'Segera Lakukan Pembayaran Untuk Segera Menikmati Fasilitas Hotel Kami.';
        }

        $customer_title = 'Pembayaran ' . $pembayaran . '!';
        $customer_message = $message;

        $payment?->user?->notify(
            new PaymentStatusNotification(
                $order, $payment, $customer_title, $customer_message
            )
        );

        $user_title = 'Terdapat Pembayaran ' . $pembayaran;
        $user_message = 'Pembayaran dengan Order ID ' . $order->id . ' ' . $pembayaran  . ' kunjungi halaman keuangan untuk detail lebih lanjut.';

        $admin = User::admin()->first();

        $office = Office::with('users')->where('accomodation_id',  $order->accomodation_id)->first();

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
