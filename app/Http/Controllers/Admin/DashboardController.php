<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountPoint;
use App\Models\ManajemanMenu;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected function getOffice()
    {
        return auth()->user()->office?->office?->accomodation_id;
    }

    public function index()
    {
        $all_point = Account::selectRaw('sum(point) as total_point, count(*) as total_account')->get();

        $all_booking = Order::get();

        $today_booking = Order::whereDate('created_at', today())->get();

        $pointin = AccountPoint::where('type', 'point_in')->get();

        $pointout = AccountPoint::where('type', 'point_out')->get();

        return view('admin.dashboard')
            ->withPoints($all_point)
            ->withBookings($all_booking)
            ->withTodaybookings($today_booking)
            ->withPointins($pointin)
            ->withPointouts($pointout);
    }

    public function orderChart(Request $request)
    {
        $orders = Order::query();

        if($request->date == 'month'){

             $orders->selectRaw('count(id) as data, month(created_at) as tanggal')->whereYear('created_at', now()->format('Y'));

        }elseif($request->date == 'year'){

            $orders->selectRaw('count(id) as data, year(created_at) as tanggal');

        }elseif($request->date == 'week'){

             $orders->selectRaw('count(id) as data, DAYOFMONTH(created_at) as tanggal')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

        }else{

            $orders->selectRaw('count(id)  as data, DAYOFMONTH(created_at) as tanggal')->whereMonth('created_at', now()->format('m'));
        }

        return $orders->groupBy('tanggal')->get();
    }

    public function pointChart(Request $request)
    {
        $pointin = AccountPoint::query();

        $pointout = AccountPoint::query();

        if($request->date == 'month'){

            $pointin->selectRaw('sum(mutation)  as data, month(created_at) as tanggal')
                ->where('type', 'point_in')
                ->whereYear('created_at', now()->format('Y'));

            $pointout->selectRaw('sum(mutation)  as data, month(created_at) as tanggal')
                ->where('type', 'point_out')
                ->whereYear('created_at', now()->format('Y'));

        }elseif($request->date == 'year'){

            $pointin->selectRaw('sum(mutation)  as data, year(created_at) as tanggal')
                ->where('type', 'point_in');

            $pointout->selectRaw('sum(mutation)  as data, year(created_at) as tanggal')
                ->where('type', 'point_out');

        }elseif($request->date == 'week'){

             $pointin->selectRaw('sum(mutation) as data, DAYOFMONTH(created_at) as tanggal')
                ->where('type', 'point_in')
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

             $pointout->selectRaw('sum(mutation) as data, DAYOFMONTH(created_at) as tanggal')
                ->where('type', 'point_out')
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

        }else{

            $pointin->selectRaw('sum(mutation) as data, DAYOFMONTH(created_at) as tanggal')
                ->where('type', 'point_in')
                ->whereMonth('created_at', now()->format('m'));

            $pointout->selectRaw('sum(mutation) as data, DAYOFMONTH(created_at) as tanggal')
                ->where('type', 'point_out')
                ->whereMonth('created_at', now()->format('m'));
        }

        return response()->json([
            'point_in' => $pointin->groupBy('tanggal')->get(),
            'point_out' => $pointout->groupBy('tanggal')->get()
        ]);
    }

    public function financeChart(Request $request)
    {
        $payments = Payment::query();

        if($request->date == 'month'){

             $payments->selectRaw('sum(amount) as data, month(created_at) as tanggal')->whereYear('created_at', now()->format('Y'));

        }elseif($request->date == 'year'){

            $payments->selectRaw('sum(amount) as data, year(created_at) as tanggal');

        }elseif($request->date == 'week'){

             $payments->selectRaw('sum(amount) as data, DAYOFMONTH(created_at) as tanggal')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

        }else{

            $payments->selectRaw('sum(amount)  as data, DAYOFMONTH(created_at) as tanggal')->whereMonth('created_at', now()->format('m'));
        }

        return $payments
                ->where('status', 'COMPLETED')
                ->orWhere('status', 'SUCCEEDED')
                ->groupBy('tanggal')
                ->get();
    }
}
