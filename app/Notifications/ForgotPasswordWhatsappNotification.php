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

        $id_device = env('WHATSAPP_ID_DEVICE'); // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url   = env('WHATSAPP_API_URL'); // URL API
        $no_hp = $this->numberFormat(); // No.HP yang dikirim (No.HP Penerima)
        $pesan = "Kode OTP Reset Password.

Harap untuk tidak membagikan kode rahasia ini kepada siapapun! 

Kode OTP anda adalah : {$this->user->otp_verify_code}

Silahkan kambali ke aplikasi dan masukkan kode OTP diatas."; // Pesan yang dikirim

        $token = env('WHATSAPP_TOKEN');
        $phone= $no_hp; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
        $message = $pesan;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => env('WHATSAPP_API_URL'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER=> false,
          CURLOPT_SSL_VERIFYHOST => false,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'token='.$token.'&number='.$phone.'&message='.$message,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
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
