<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountPoint;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $all_point = Account::selectRaw('sum(point) as total_point, count(*) as total_account')->get();

        $all_booking = Order::get();

        $today_booking = Order::where('created_at', today())->get();

        $pointin = AccountPoint::where('type', 'point_in')->get();

        $pointout = AccountPoint::where('type', 'point_out')->get();

        return view('admin.dashboard')
            ->withPoints($all_point)
            ->withBookings($all_booking)
            ->withTodaybookings($today_booking)
            ->withPointins($pointin)
            ->withPointouts($pointout);
    }
}
