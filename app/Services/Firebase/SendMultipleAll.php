<?php  

namespace App\Services\Firebase;
use App\Models\User;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class SendMultipleAll
{
	public static function send($request)
	{
        $users = User::whereNotNull('device_token')->get();
        $deviceTokens = $users->pluck('device_token')->toArray();

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

        $allmessage = CloudMessage::new()
                    ->withNotification($notification)
                    ->withData($data);

        $messaging = app('firebase.messaging');

        $sendReport = $messaging->sendMulticast($allmessage, $deviceTokens);

	}
}