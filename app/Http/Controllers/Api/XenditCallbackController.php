<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CallbackXendit;
use App\Models\Payments\Ewallet;
use Illuminate\Http\Request;

class XenditCallbackController extends Controller
{
    public function ewallet(Request $request)
    {
        $data = json_encode($request->all());
        \Log::info($data);

        $callback = CallbackXendit::create([
            'payload' => $data
        ]);

        $status = json_decode($callback->payload);

        $ewallet = Ewallet::where('ewallet_id', $status?->data?->id)->first();

        $ewallet->update([
            'payload' => $data
        ]);

        $ewallet->payment()->update([
            'status' => $status?->data?->status,
            'amount' => $status?->data?->charge_amount,
        ]);
    }

    public function ovo(Request $request)
    {
        $data = json_encode($request->all());
        \Log::info($data);

        $callback = CallbackXendit::create([
            'payload' => $data
        ]);
        
        $status = json_decode($callback->payload);

        $ewallet = Ewallet::where('ewallet_id', $status?->data?->id)->first();

        $ewallet->update([
            'payload' => $data
        ]);

        $ewallet->payment()->update([
            'status' => $status?->data?->status,
            'amount' => $status?->data?->charge_amount,
        ]);
    }

    public function virtualAccount(Request $request)
    {
        $callback = CallbackXendit::create([
            'payload' => json_encode($request->all())
        ]);

        return $callback;
    }
}
