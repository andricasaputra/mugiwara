<?php  

namespace App\Services\Firebase;
use App\Models\User;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class SendMultiple
{

	public static function send($request)
	{
        $deviceTokens = $request->receiver;
        
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

        $message = CloudMessage::new()
                    ->withNotification($notification)
                    ->withData($data);

        $messaging = app('firebase.messaging');

        $sendReport = $messaging->sendMulticast($message, $deviceTokens);
        
	}
}