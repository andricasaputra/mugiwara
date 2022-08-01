<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user()->notifications
        ]);
    }

    public function categories()
    {
        return response()->json([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'pemberitahuan'
                ],
                [
                    'id' => 2,
                    'name' => 'rating'
                ]
            ]
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'data' => request()->user()->notifications()->where('id', $id)->first()
        ]);
    }

    public function markAsRead($id)
    {
        $notification = request()->user()->notifications()->where('id', $id)->first();

        $notification = $notification->update(['read_at' => now()]);

        return response()->json([
            'data' => request()->user()->notifications()->where('id', $id)->first()
        ]);
    }
}
