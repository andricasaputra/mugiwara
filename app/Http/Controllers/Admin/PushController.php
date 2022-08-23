<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;

class PushController extends Controller
{
    public function index()
    {
        $messaging = app('firebase.messaging');

        $deviceToken = 'cuIhMTpxSlWAo-wDVJN5rG:APA91bFjUPg6HXtAZueEGptYrkMVeblxdZuGF4L5cV4myPEPL4SvfxhZjoq4csjXMUTueKsR5wLnmCR9qtZRM-PPVeDiD4u2NlGTyeLd4h5m49_RsiiWvm9BF0_VTYPXllr4odYpg1j7';

        $data = [
            'title' => 'Ini data title dari backend',
            'text' => 'Ini data text title dari backend'
        ];

        $notification = [
            'title' => 'Ini notification title dari backend',
            'body' => 'Ini notification body title dari backend'
        ];

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withData($data);

        $res = $messaging->send($message);

        dd($res);
    }
}
