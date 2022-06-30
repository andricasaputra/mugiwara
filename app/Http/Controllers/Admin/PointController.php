<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountPoint;
use App\Models\Customer;
use Illuminate\Http\Request;

class PointController extends Controller
{
    
    public function index()
    {
        $customers = Customer::where('type', 'customer')->get();
        return view('admin.point.index', compact('customers'));
    }
    public function show($id)
    {
        $customer = Customer::find($id);
        $accountPoints = AccountPoint::where('user_id', $id)->get();
        return view('admin.point.show_point', compact('accountPoints','customer'));
    }
    
}
