<?php

namespace App\Notifications;

use App\Contracts\NotificationInterface;
use App\Notifications\WhatsappChannel;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class sendResetLinkWhatsapplNotification extends Notification implements NotificationInterface
{
    use Queueable;

     /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to create the verify pesan URL.
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
    public function __construct(protected $user)
    {
        $this->token = Str::random(16);
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
        DB::table('password_resets')->insert([
            'mobile_number' => $this->user->mobile_number,
            'token' => $this->token,
            'created_at' => now()
        ]);

        $data = [
            'api_key' => 'b2d95af932eedb4de92b3496f338aa5f97b36ae0',
            'sender'  => '6281238422099',
            'number'  => $this->numberFormat(),
            'message' => "Notifikasi reset password

Anda mendapatkan pesan ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun anda.

Klik atau salin link dibawah ini untuk mengatur ulang kata sandi anda

" . $this->resetUrl($notifiable) . "

Jika Anda tidak meminta pengaturan ulang kata sandi, maka tidak ada tindakan lebih lanjut yang diperlukan 

" . env('APP_NAME') . "",

        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://wa.eqosistem.com/app/api/send-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data))
        );

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        if($response['status']) return;
        
        throw new \Exception("Whastapp notification error");
    }

    public function getNotificationType()
    {
        return 'nomor whatsapp';
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
     * Get the reset URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(route('api.reset.password', [
            'token' => $this->token,
            'mobile_number' => $this->user->mobile_number,
        ], false));
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
     * Set a callback that should be used when creating the pesan verification URL.
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
