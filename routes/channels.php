<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('order-channel', function ($user) {
    return true;
}); 

Broadcast::channel('payment-channel', function ($user) {
    return true;
}); 


Broadcast::channel('redeem-channel', function ($user) {
    return true;
}); 

Broadcast::channel('withdraw-channel', function ($user) {
    return true;
}); 

Broadcast::channel('withdraw-response-channel', function ($user) {
    return true;
}); 


