<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function validateUser(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'order_id' => 'required'
        ]);

        $check = Review::where('order_id', $request->order_id)->where('reviewable_id', $request->room_id)->where('user_id', $request->user()->id)->first();

        if($check){
            return response()->json([
                'data' => [
                    'is_reviewable' => false
                ]
            ]);
        } 

        return response()->json([
            'data' => [
                'is_reviewable' => true
            ]
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'room_id' => 'required',
            'order_id' => 'required'
        ]);

        $review = Review::create([
            'reviewable_id' => $request->room_id,
            'reviewable_type' => Room::class,
            'user_id' => request()->user()->id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'data' => $review,
            'message' => 'succcessfully add review'
        ]);
    }
}
