<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function status(Request $request)
    {
        $request->validate([
            'room_id' => 'required'
        ]);

        return response()->json([
            'data' => Room::findOrfail(request()->room_id)->only(['id', 'status', 'booked_untill', 'stayed_untill'])
        ]);
    }

    public function list(Request $request)
    {
        return Room::with('type')->where('accomodation_id', $request->id)->get();
    }
}
