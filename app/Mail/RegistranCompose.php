<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistranCompose extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($compose)
    {
        $this->details = $compose;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from(env('MAIL_FROM_ADDRESS', 'no-reply@capsuleinn.id'))
        ->to($this->details->to)
        ->subject($this->details->subject)
        ->view('vendor.mail.compose')
        ->with([
            'compose' => $this->details
        ]);
    }
}
