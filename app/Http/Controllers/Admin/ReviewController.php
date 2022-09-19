<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Accomodation $accomodation)
    {
        $reviews = Review::whereHas('reviewable', function($query) use($accomodation) {
            $query->whereIn('reviewable_id', $accomodation?->room?->pluck('id'));
        })->paginate(5);

        return view('admin.booking.rooms.review.index')
            ->withReviews($reviews)
            ->withAccomodation($accomodation)
            ->withRoom($accomodation->room);
    }

    public function edit(Accomodation $accomodation, Review $review)
    {
        return view('admin.booking.rooms.review.edit') ->withAccomodation($accomodation)->withReview($review);
    }

    public function update(Request $request, Accomodation $accomodation, Review $review)
    {
        $request->validate([
            'rating' => 'required',
            'comment' => 'required'
        ]);

        $review->update($request->all());

        return redirect(route('rooms.reviews.index', $accomodation->id))->withSuccess('Berhasil Perbarui Review');
    }
}
