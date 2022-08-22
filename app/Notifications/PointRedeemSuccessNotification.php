<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PointRedeemSuccessNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected $accountPoin, protected $voucher)
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Penukaran Poin Berhasil!',
            'message' => 'Terimaksih telah menukarkan point anda, Gunakan sebelum batas waktu yang sudah ditentukan',
            'history' => $this->accountPoin,
            'voucher' => $this->voucher,
            'type' => 'point',
            'category' => 'pemberitahuan'
        ];
    }
}