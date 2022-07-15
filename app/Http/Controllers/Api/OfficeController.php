<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfficeResource;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::when(request()->has('search'), function($query){
            $query->where('name', 'like', '%'. request()->search . '%')
                ->orWhereHas('accomodation', function($query){
                    $query->where('name', 'like', '%'. request()->search . '%');
                });
        })->paginate(request()->has('take') ? request()->take : 10);

        return OfficeResource::collection($offices);
    }
}
