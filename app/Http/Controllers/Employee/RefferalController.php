<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;

class RefferalController extends Controller
{
    public function index()
    {
        return view('admin.refferals.index')->withRefferals(Affiliate::latest()->get());
    }
}
