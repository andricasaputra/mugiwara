<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class RoomReviewsNotification extends Notification implements ShouldQueue
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
        return ['database'];
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
                    ->subject(Lang::get('Checkout Menginap'))
                    ->line(Lang::get('Terimkasih telah menginap di ' . env('APP_NAME')))
                    ->line(Lang::get('Kode Booking : ' . $this->order?->booking_code))
                    ->line(Lang::get('Waktu check out : ' . $this->order?->check_out_date))
                    ->line(Lang::get('Jika anda merasa tidak menginap, silahkan abaikan pesan ini.'))
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
            'title' => 'Beri rating selama menginap',
            'message' => 'Terimakasih atas kedatangan anda, kami harap waktu menginap anda menyenangkan!',
            'type' => 'rating',
            'category' => 'rating',
            'order_id' => $this->order->load(['accomodation:id,name' , 'room']),
            'review_url' => route('api.review.create')
        ];
    }
}
