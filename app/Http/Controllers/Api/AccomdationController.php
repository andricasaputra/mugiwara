<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccomodationResource;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\ShowAccomodationResource;
use App\Models\Accomodation;
use App\Models\Order;
use App\Models\Room;
use App\Models\Type;
use App\Repositories\AccomodationRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

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

    public function rooms($name)
    {
        $accomodations = Accomodation::where('name', $name)->get();

        $data = [];

        foreach($accomodations as $accomodation){
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

            $data[] = collect($accomodation)
                    ->put('total_room', $accomodation->room()->count())
                    ->put('available_room_count', $rooms->where('status', 'available')->count())
                    ->put('room_type_count', $room_type)
                    ->put('rooms', new RoomCollection($rooms));
        }

        
                
        return ShowAccomodationResource::collection($data);
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

        $orders = Order::with(['room' => function($query) use($type){
                        $query->where('type_id', $type->id);
                    }])->where('accomodation_id', $request->accomodation_id)
                    ->where('order_status', '!=' , 'cancel')
                    ->where('check_in_date', $request->start_date)
                    ->orWhere('check_in_date', $request->end_date)
                    ->get();

        $check_in_date = $orders->pluck('check_in_date');
        $stay_days = $orders->pluck('stay_day');
        
        $dates = [];
        foreach($stay_days as $key => $stay_day){
            $startDate = Carbon::createFromFormat('Y-m-d', $check_in_date[$key]);
            $endDate = Carbon::parse($check_in_date[$key])->addDays($stay_day);
      
            $dateRange = CarbonPeriod::create($startDate, $endDate);
       
            $dates[] = $dateRange->toArray();
            
        }

        $rooms = Room::where('accomodation_id', request()->accomodation_id)
            ->where('type_id', $type->id)
            ->get();

        $stayed_date = $rooms->pluck('stayed_untill')->filter(fn($data) => !is_null($data))->toArray();

        $booked_date = $rooms->pluck('booked_untill')->filter(fn($data) => !is_null($data))->toArray();

        $notAvailableRoom = 0;


        foreach($booked_date as $bk){
            if($bk == $request->start_date || $bk == $request->end_date){
                $notAvailableRoom += 1;
            }   
        }

        foreach($stayed_date as $st){
            if($st == $request->start_date || $st == $request->end_date){
                $notAvailableRoom += 1;
            }   
        }

        $total = $rooms->count() - $notAvailableRoom - $orders->count();

        if($total >= 1){
            return response()->json([
                'data' => [
                    'is_available' => true, 
                    'available_room' => $total
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'is_available' => false, 
                'available_room' => 0
            ]
        ]);
        
    }

}
