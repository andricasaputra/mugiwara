<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CallbackXendit;
use Illuminate\Http\Request;

class XenditCallbackController extends Controller
{
    public function ewallet(Request $request)
    {
        $data = $request->all();
        \Log::info($data);

        $callback = CallbackXendit::create([
            'payload' => $data
        ]);

    }

    public function ovo(Request $request)
    {
        $data = $request->all();
        \Log::info($data);

        $callback = CallbackXendit::create([
            'payload' => $data
        ]);
    }

    public function virtualAccount(Request $request)
    {
        $callback = CallbackXendit::create([
            'payload' => $request->all()
        ]);

        return $callback;
    }
}
