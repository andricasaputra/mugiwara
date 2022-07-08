<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;

class PaymentController extends Controller
{
    public function __construct()
    {
         Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
    }

    public function lists()
    {
        $lists = \Xendit\PaymentChannels::list();
        $lists = collect($lists)->filter(fn($list) => $list['is_enabled']);

        return response()->json($lists);
    }
}
