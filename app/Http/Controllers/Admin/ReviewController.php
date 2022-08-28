<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Room $room)
    {
        $reviews = Review::whereHas('reviewable', function($query) use($room) {
            $query->where('reviewable_id', $room->id);
        })->paginate(5);

        return view('admin.booking.rooms.review.index')
            ->withReviews($reviews)
            ->withRoom($room);
    }

    public function edit(Room $room, Review $review)
    {
        return view('admin.booking.rooms.review.edit') ->withRoom($room)->withReview($review);
    }

    public function update(Request $request, Room $room, Review $review)
    {
        $request->validate([
            'rating' => 'required',
            'comment' => 'required'
        ]);

        $review->update($request->all());

        return redirect(route('rooms.reviews.index', $room->id))->withSuccess('Berhasil Perbarui Review');
    }
}
