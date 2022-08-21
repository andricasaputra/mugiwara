<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PaymentExport;
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

        return Excel::download(new PaymentExport($request), 'pembayaran.xlsx');
    }
}
