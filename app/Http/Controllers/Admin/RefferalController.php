<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;

class RefferalController extends Controller
{
    public function index()
    {
        $affiliates = Affiliate::with(['user', 'followers.user'])->get();

        return view('admin.refferals.index')->withRefferals($affiliates);
    }

    public function show(Affiliate $refferral)
    {//dd($refferral->load(['user', 'followers.user']));
        return view('admin.refferals.show')->withRefferral($refferral->load(['user', 'followers.user']));
    }
}
