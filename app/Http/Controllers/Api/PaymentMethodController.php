<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethodList;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => PaymentMethodList::all()
        ]);
    }

    public function show($name)
    {
        $list = PaymentMethodList::where('name', 'like', '%' . $name . '%')->get();

        return response()->json([
            'data' => $list
        ]);
    }
}
