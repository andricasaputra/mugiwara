<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    public function showRegencies($id = null)
    {
        $regency = Regency::whereProvinceId($id)->get();

        return response()->json(compact('regency'));
    }

     public function showDistricts($id = null)
    {
        $districts = District::whereRegencyId($id)->get();

        return response()->json(compact('districts'));
    }

}
