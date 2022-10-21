<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        if(! auth()->user()->hasRole('admin_cabang')) abort(403);

        $withdraws = Withdraw::where('user_id', auth()->id())->with(['user', 'image'])->latest()->get();

        return view('employee.finance.withdraw.index')->with('withdraws', $withdraws);
    }
}
