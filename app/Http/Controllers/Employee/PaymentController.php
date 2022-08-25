<?php

namespace App\Http\Controllers\Employee;

use App\Exports\PaymentEmployeeExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    public function export(Request $request) 
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required'
        ]);

        return Excel::download(new PaymentEmployeeExport($request), 'pembayaran.xlsx');
    }
}
