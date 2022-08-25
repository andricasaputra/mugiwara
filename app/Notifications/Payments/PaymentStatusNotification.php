<?php

namespace App\Notifications\Payments;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PaymentStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        protected \App\Models\Order $order, 
        protected \App\Models\Payment $payment,
        protected $title = null,
        protected $message = null
    )
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
                    ->subject(Lang::get(' Pembayaran Berhasil'))
                    ->line(Lang::get('Terimkasih telah melakukan pembayaran untuk kode booking : ' . $this->order?->booking_code))
                    ->line(Lang::get('Order ID : ' . $this->payment?->order_id))
                    ->line(Lang::get('Jumlah total pembayaran Rp : ' . $this->payment?->amount))
                    ->action(Lang::get('Status : ' . strtolower($this->payment?->status)), $url = '')
                    ->line(Lang::get('Terimkasih atas kepercayaan anda.'))
                    ->salutation(Lang::get(env('APP_NAME')));
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
            'payment' => $this->payment,
            'type' => 'common',
            'category' => 'pemberitahuan'
        ];
    
    }
}
