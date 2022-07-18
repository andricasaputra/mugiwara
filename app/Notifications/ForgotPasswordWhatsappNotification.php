<?php

namespace App\Notifications;

use App\Notifications\WhatsappChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class ForgotPasswordWhatsappNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected $user)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhatsappChannel::class];
    }

     /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toWhatsapp($notifiable)
    {

        $api_key   = 'ae7d8d1b89b362ed342ee1e1da0e181d4219673f'; // API KEY Anda
        $id_device = '5746'; // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url   = 'https://api.watsap.id/send-message'; // URL API
        $no_hp = $this->numberFormat(); // No.HP yang dikirim (No.HP Penerima)
        $pesan = "Kode OTP Reset Password.

Harap untuk tidak membagikan kode rahasia ini kepada siapapun! 

Kode OTP anda adalah : {$this->user->otp_verify_code}

Silahkan kambali ke aplikasi dan masukkan kode OTP diatas."; // Pesan yang dikirim

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POST, 1);

        $data_post = [
           'id_device' => $id_device,
           'api-key' => $api_key,
           'no_hp'   => $no_hp,
           'pesan'   => $pesan
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($curl);
        curl_close($curl);

        if(!is_null($response) && $response['status']){
            return response()->json([
                'message' => 'verifikasi nomor telepon sukses!'
            ]);
        } 
    }

    protected function numberFormat()
    {
        $number = $this->user->mobile_number;
        $number = str_replace(' ', '-', $number);
        $number = preg_replace("/[^0-9\-]+/", "", $number);

        $first_character = substr($number, 0, 1);

        if($first_character == 0 || $first_character == '0'){
            $number = substr_replace($number, "62", 0, 1);
        }

        return $number;
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        return route(
            'verification.mobile.verify',
            Carbon::now()->addMinutes(config()->get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
