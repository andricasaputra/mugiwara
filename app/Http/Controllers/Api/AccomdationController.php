<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccomodationResource;
use App\Models\Accomodation;
use App\Repositories\AccomodationRepository;
use Illuminate\Http\Request;

class AccomdationController extends Controller
{
    public function __construct(protected AccomodationRepository $repository)
    { 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AccomodationResource::collection($this->repository->all());
    }

    public function rooms(Accomodation $accomodation)
    {
        return AccomodationResource::make($accomodation->load([
            'roomAvailable.facilities',
            'roomAvailable.reviews'
        ]));

        //  $room = $accomodation->room->map(function($room){
        //     $room['avg_rating'] = $room->reviews->avg('ratings');

        //     return $room;
        // });

        // $accomodation = $accomodation->load(['province', 'regency', 'room' => function($query) {
        //     $query->withAvg('reviews', 'rating');
        // }]);

        // $accomodation = (collect) array_merge($accomodation->toArray(), $room->toArray());


        // //return $accomodation;

        //     return new AccomodationResource($accomodation);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
