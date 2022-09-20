<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class AdminOrderCreatedNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected \App\Models\Order $order, protected $title, protected $message)
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
                    ->line(Lang::get('Proses pemesanan  kamar yang dipesan ' . env('APP_NAME') . ' ' . $this->order?->accomodation?->name))
                    ->line(Lang::get('Berikut detail informasi pemesanan oleh pelanggan anda :'))
                    ->line(Lang::get('Nama Pelanggan  : ' . $this->order?->user?->name))
                    ->line(Lang::get('Kode Booking : ' . $this->order?->booking_code))
                    ->line(Lang::get('Waktu Menginap : ' . $this->order?->stay_day))
                    ->action(Lang::get('Total tagihan Rp : ' . $this->order?->total_price), $url = '')
                    ->line(Lang::get('Silahkan lakukan pemeriksaan kembali untuk mengantisipasi adanya kesalahan.'))
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
            'title' => $this->title,
            'message' => $this->message,
            'order' => $this->order,
            'type' => 'common',
            'category' => 'pemberitahuan'
        ];
    }
}
