<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderOffline;
use Illuminate\Http\Request;

class OrderOfflineController extends Controller
{
    public function index()
    {
        $orders = OrderOffline::with('payment')->latest()->get();

        return view('admin.order_offline.index')->withOrders($orders);
    }

    public function create()
    {
        return view('admin.order_offline.create');
    }

    public function edit($id)
    {
        return view('admin.order_offline.edit');
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        //
    }

    public function checkInPage(Request $request)
    {
        //
    }

    public function checkIn(Request $request)
    {
        //
    }

    public function checkOut(Request $request)
    {
        //
    }
}
