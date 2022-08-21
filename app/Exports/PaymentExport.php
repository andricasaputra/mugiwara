<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PaymentExport implements FromView
{
    public function __construct(protected $request)
    {
    }

    public function view(): View
    {
        $payments = Payment::whereBetween('created_at', [$this->request->from, $this->request->to])->with(['user', 'payable', 'voucher', 'order.accomodation', 'order.room.type'])->get();

        return view('admin.finance.excel', [
            'payments' => $payments,
            'date' => $this->request
        ]);
    }
}
