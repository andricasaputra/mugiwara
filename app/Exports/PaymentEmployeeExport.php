<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PaymentEmployeeExport implements FromView
{
    public function __construct(protected $request)
    {
    }

    public function view(): View
    {
        $payments = Payment::whereBetween('created_at', [$this->request->from, $this->request->to])->with(['user', 'payable', 'voucher', 'order.accomodation', 'order.room.type'])->whereHas('order', function($query){
            $query->where('accomodation_id', auth()->user()->office?->office?->accomodation_id);
        })->get();

        return view('admin.finance.excel', [
            'payments' => $payments,
            'date' => $this->request
        ]);
    }
}
