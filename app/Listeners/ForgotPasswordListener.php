<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ForgotPasswordListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if($event->request->email){
            $event->user->sendForgotPasswordOtpViaEmailNotification();
        }else{
            $event->user->sendForgotPasswordOtpViaWhatsappNotification();
        }
        
    }
}
