<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    public function showProvinces()
    {
        $province = Province::select(['id', 'name'])->get();

        return response()->json(compact('province'));
    }

    public function showRegencies($id = null)
    {
        $regency = Regency::select(['id', 'province_id', 'name'])
            ->with('province:id,name')
            ->whereProvinceId($id)->get();

        return response()->json(compact('regency'));
    }

     public function showDistricts($id = null)
    {
        $districts = District::select(['id', 'regency_id', 'name'])
            ->with('regency:id,name')
            ->whereRegencyId($id)->get();

        return response()->json(compact('districts'));
    }

}
