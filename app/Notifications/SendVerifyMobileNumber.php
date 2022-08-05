<?php

namespace App\Notifications;

use App\Notifications\WhatsappChannel;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendVerifyMobileNumber extends Notification
{
    use Queueable;

    /**
     * The callback that should be used to create the verify email URL.
     *
     * @var \Closure|null
     */
    public static $createUrlCallback;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toWhatsappCallback;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected \App\Models\User $user)
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
        try {

        $id_device = env('WHATSAPP_ID_DEVICE'); // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url   = env('WHATSAPP_API_URL'); // URL API
        $no_hp = $this->numberFormat(); // No.HP yang dikirim (No.HP Penerima)
        $pesan = "Notifikasi verifikasi nomor telepon!

Mohon untuk tidak mebagikan kode rahasia berikut kepada siapapun! 

Kode Verifikasi anda adalah : {$this->user->mobile_verify_code}

Silahkan masukkan kode diatas pada layar Handpone anda di dalam aplikasi CapsuleInn.

Hormat kami,

Capsule Inn"; // Pesan yang dikirim

        $token = env('WHATSAPP_TOKEN');
        $phone= $no_hp; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
        $message = $pesan;

        //dd($token);

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'POST',
        //   CURLOPT_POSTFIELDS => 'token='.$token.'&number='.$phone.'&message='.$message,
        // ));

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

        } catch (\Exception $e) {

            dd($e->getMessage());
            throw new \Exception("Whatsaap error, please connect your number to whatsapp gateway", 1);
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
            $number = str_replace("-", "", $number);
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

    /**
     * Set a callback that should be used when creating the email verification URL.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function createUrlUsing($callback)
    {
        static::$createUrlCallback = $callback;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toWhatsappUsing($callback)
    {
        static::$toWhatsappCallback = $callback;
    }
}
