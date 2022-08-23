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

        // $users = User::whereId('device_token')->get();

        // $deviceToken = NULL;

        $topic = 'test-topic';

        $data = [
            'title' => 'Ini data title dari backend',
            'text' => 'Ini data text title dari backend'
        ];

        $notification = [
            'title' => 'Ini notification title dari backend',
            'body' => 'Ini notification body title dari backend'
        ];

        // $message = CloudMessage::withTarget('token', $deviceToken)
        //     ->withData($data);

        $topic = 'a-topic';

        $message = CloudMessage::withTarget('topic', $topic)
            ->withData($data) // optional
        ;

        $res = $messaging->send($message);

        dd($res);
    }
}
