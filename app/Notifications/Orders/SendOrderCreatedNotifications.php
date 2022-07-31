<?php

namespace App\Notifications\Orders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class SendOrderCreatedNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected \App\Models\Order $order)
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                   ->greeting('Halo ' . ucfirst($notifiable->name))
                    ->subject(Lang::get('Order Detail'))
                    ->line(Lang::get('Terimkasih telah memesan kamar di ' . env('APP_NAME')))
                    ->line(Lang::get('Kode Booking : ' . $this->order?->booking_code))
                    ->line(Lang::get('Perkiraan waktu check in anda : ' . $this->order?->check_in_date))
                    ->line(Lang::get('Jumlah hari menginap : ' . $this->order?->stay_day))
                    ->action(Lang::get('Jumlah total tagihan Rp : ' . $this->order?->total_price), $url = '')
                    ->line(Lang::get('Jika anda merasa tidak memesan, silahkan abaikan pesan ini.'))
                    ->salutation(Lang::get('Terimakasih'));
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
            'title' => 'Pesanan Kamar Segera Diproses',
            'message' => 'Terimakasih telah melakukan pemesanan di Capsule Inn, Segera lakukan pembayaran sesuai tagihan yang ada.',
            'order' => $this->order
        ];
    }
}
