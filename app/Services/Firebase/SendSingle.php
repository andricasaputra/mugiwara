<?php  

namespace App\Services\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Contract\Messaging;

class SendSingle
{
	public function send($request)
	{
		$deviceToken = $request->receiver[0];

        $data = [
            'title' => $request->title,
            'text' => $request->text,
            'image' => url('storage/misc/capsuleinnlogo.png'),
        ];

        $notification = [
            'title' => $request->title,
            'body' => $request->text,
            'image' => url('storage/misc/capsuleinnlogo.png'),
        ];

        $message = CloudMessage::fromArray([
            'token' => $deviceToken,
            'notification' => $notification,
            'data' => $data,
        ]);

        $messaging = app('firebase.messaging');

       	$messaging->send($message);
	}
}