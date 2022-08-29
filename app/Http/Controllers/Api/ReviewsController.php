<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccountPoint;
use App\Models\Customer;
use App\Models\Review;
use App\Models\Room;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\ReviewAndStayPointNotification;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function validateUser(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'order_id' => 'required'
        ]);

        $review = Review::where('order_id', $request->order_id)->where('reviewable_id', $request->room_id)->where('user_id', $request->user()->id)->first();

        if($review){
            return response()->json([
                'data' => [
                    'is_reviewable' => false,
                    'review' => $review->load(['reviewable', 'user'])
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

        $setting = Setting::where('name', 'point_menginap')->first();

        if($setting && $setting?->is_active == 1){

            $customer = Customer::find($request->user()->id);
            $user = User::find($request->user()->id);
            
            $user?->notify(
                new ReviewAndStayPointNotification($setting)
            );

            $customer?->notify(
                new ReviewAndStayPointNotification($setting)
            );

            $user = $request->user();

            $pointBefore = $user->account?->point;
            $pointAfter = $pointBefore + $setting?->value ?? 0;

            $user->account()?->update([
                'point' => $pointAfter
            ]);

            AccountPoint::create([
                'user_id' => $user->id,
                'review_id' => $review->id,
                'before' => $pointBefore,
                'after' => $pointAfter,
                'mutation' => $setting?->value ?? 0,
                'type' => 'point_in'
            ]);
        }

        return response()->json([
            'data' => $review,
            'message' => 'succcessfully add review'
        ]);
    }
}
