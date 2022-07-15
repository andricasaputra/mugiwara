<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicies;
use App\Models\Term;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $privacy = PrivacyPolicies::get();

        return response()->json(['data' => $privacy]);
    }
}
