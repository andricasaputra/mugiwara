<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user', 'order', 'payable'])->get();

        dd($payments);

        return view('admin.finance.index')->withPayments($payments);
    }
}
