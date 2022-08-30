<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlayStoreLink;

class PlayStoreController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => PlayStoreLink::first()
        ]);
    }
}
