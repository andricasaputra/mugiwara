<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductUser;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $produvtUsers = ProductUser::all();
        $products = ProductUser::latest()->with(['product', 'user'])->get();
        if($request->category){
            $notif = $request->user()->notifications->where('data.category', $request->category)->flatten(1);
        } else {
            $notif = $request->user()->notifications;
        }

        return response()->json([
            // 'data' => $products
            'data' => $notif,
            // 'produvt_users' => $produvtUsers,
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
                ],
                [
                    'id' => 3,
                    'name' => 'refund'
                ],
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
