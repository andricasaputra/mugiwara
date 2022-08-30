<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppStoreLink;

class AppStoreController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => AppStoreLink::first()
        ]);
    }
}
