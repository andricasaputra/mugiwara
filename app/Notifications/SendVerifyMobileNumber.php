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

        $api_key   = 'ae7d8d1b89b362ed342ee1e1da0e181d4219673f'; // API KEY Anda
        $id_device = '5746'; // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url   = 'https://api.watsap.id/send-message'; // URL API
        $no_hp = $this->numberFormat(); // No.HP yang dikirim (No.HP Penerima)
        $pesan = "Notifikasi verifikasi nomor telepon!

        Mohon untuk tidak mebagikan kode rahasia berikut kepada siapapun! 

        Kode Verifikasi anda adalah : {$this->user->mobile_verify_code}

        Silahkan masukkan kode diatas pada layar Handpone anda di dalam aplikasi CapsuleInn.

        Hormat kami,

        Capsule Inn"; // Pesan yang dikirim

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

        throw new \Exception("Whatsaap error, please connect your number to whatsapp gateway", 1);
            
            
        } catch (\Exception $e) {
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
