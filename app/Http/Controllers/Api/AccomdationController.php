<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccomodationResource;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\ShowAccomodationResource;
use App\Models\Accomodation;
use App\Models\Room;
use App\Models\Type;
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
        $rooms = Room::query();
        $types = Type::all();

        $room_type = [];

        foreach($types as $type){
            $room_type[$type->name] = $rooms->where('accomodation_id', $accomodation->id)->with('type')->get()
            ->where('type.name', $type->name)
            ->count();
        }

        $rooms = $rooms->with([
            'images' ,
            'facilities', 
            'reviews',
            'type'
        ])->where('accomodation_id', $accomodation->id)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->get();

        $data = collect($accomodation)
                ->put('total_room', $accomodation->room()->count())
                ->put('available_room_count', $rooms->where('status', 'available')->count())
                ->put('room_type_count', $room_type)
                ->put('rooms', new RoomCollection($rooms));

        return new ShowAccomodationResource($data);
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

    public function status(Request $request)
    {

        $request->validate([
            'accomodation_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'room_type' => 'required'
        ]);

        $type = Type::whereName(request()->room_type)->first();

        $status = Room::where('accomodation_id', request()->accomodation_id)
            ->where('type_id', $type->id)
            ->get();

         $count = Room::where('accomodation_id', request()->accomodation_id)
                    ->where('type_id', $type->id)
                    ->where('status', 'available')
                    ->get()->count();

        if($count >= 1){
            return response()->json([
                'data' => [
                    'is_available' => true, 
                    'available_room' => $count
                ]
            ]);
        }


        return response()->json([
            'data' => [
                'is_available' => false, 
                'available_room' => $count
            ]
        ]);

        return ;
        
    }

}
