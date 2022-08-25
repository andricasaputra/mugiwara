<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountPoint;
use App\Models\Customer;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index()
    {
        $accountPoints = AccountPoint::all();

        $customers = Customer::where('type', 'customer')->get();

        return view('employee.point.index', compact('accountPoints'));
    }
    
    public function show($id)
    {
        $accountPoint = AccountPoint::find($id);

        $customer = Account::where('user_id', $accountPoint->user_id)->first();

        $accountPoints = AccountPoint::has('voucher')->where('user_id', $accountPoint->user_id)->get();
        
        return view('employee.point.show_point', compact('accountPoints', 'accountPoint','customer'));
    }
    
}
