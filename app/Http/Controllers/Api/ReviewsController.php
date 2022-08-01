<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'accomodation_id' => 'required',
            'room_id' => 'required'
        ]);

        $review = Review::create([
            'reviewable_id' => $request->room_id,
            'reviewable_type' => Room::class,
            'user_id' => request()->user()->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'data' => $review,
            'message' => 'succcessfully add review'
        ]);
    }
}
