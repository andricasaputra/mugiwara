<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CallbackXendit;
use Illuminate\Http\Request;

class XenditCallbackController extends Controller
{
    public function ewallet(Request $request)
    {
        $url = 'https://api.xendit.co/callback_urls';
          $apiKey = env('XENDIT_SECRET_KEY');
          $headers = [];
          $headers[] = 'Content-Type: application/json';
          $data = [
              'url' => 'https://www.xendit.co/callback_catcher'
          ];

          $curl = curl_init();

          $payload = json_encode($data);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($curl, CURLOPT_USERPWD, $apiKey.":");
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

          $result = curl_exec($curl);
          //echo $result;

            $callback = CallbackXendit::create([
                'payload' => $result
            ]);

            return $callback;
    }

    public function ovo(Request $request)
    {
        $url = 'https://api.xendit.co/callback_urls';
          $apiKey = env('XENDIT_SECRET_KEY');
          $headers = [];
          $headers[] = 'Content-Type: application/json';
          $data = [
              'url' => 'https://www.xendit.co/callback_catcher'
          ];

          $curl = curl_init();

          $payload = json_encode($data);
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($curl, CURLOPT_USERPWD, $apiKey.":");
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

          $result = curl_exec($curl);
          //echo $result;

        $callback = CallbackXendit::create([
            'payload' => $results
        ]);

        return $callback;
    }

    public function virtualAccount(Request $request)
    {
        $callback = CallbackXendit::create([
            'payload' => $request->all()
        ]);

        return $callback;
    }
}
