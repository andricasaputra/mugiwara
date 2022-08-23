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

        $topic = 'pengumuman';

        $message = CloudMessage::fromArray([
            'topic' => $topic,
            'notification' => [], // optional
            'data' => ['title' => 'tes title', 'body' => 'test body'], // optional
        ]);

        $res = $messaging->send($message);

        dd($res);
    }
}
