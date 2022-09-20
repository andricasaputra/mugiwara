<?php

namespace App\Notifications\Orders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class OrderDetailEmailNotification extends Notification implements ShouldQueue
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
        return ['mail'];
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
            ->line(Lang::get('Selamat, anda telah berhasil melakukan pemesanan kamar dihotel ' . $this->order?->accmodation?->name))
            ->line(Lang::get('Berikut ini adalah detail pemesanan anda : '))
            ->line(Lang::get('Kode Booking : ' . $this->order?->booking_code))
            ->line(Lang::get('Waktu Check in : ' . $this->order?->check_in_date))
            ->line(Lang::get('Waktu Menginap : ' . $this->order?->stay_day))
            ->action(Lang::get('Harga Per Malam Rp : ' . $this->order?->accomodation?->room?->price), $url = '')
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
            //
        ];
    }
}
