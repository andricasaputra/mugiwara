<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilterResource;
use App\Models\Facility;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Type;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $location = Province::select('id', 'name')->has('accomodation')->get();

        $room = Type::select('id', 'name')->has('rooms')->get();

        $facilities = Facility::select('id', 'name')->has('room')->get();

        return FilterResource::collection([
            'location' => $location, 
            'room_type' => $room,
            'ratings' => [
                ['id' => 1, 'name' => 1],
                ['id' => 2, 'name' => 2],
                ['id' => 3, 'name' => 3],
                ['id' => 4, 'name' => 4],
                ['id' => 5, 'name' => 5],
            ],
            'facilities' => $facilities,
        ]);
    }
}
