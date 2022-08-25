<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Xendit\Xendit;
use Barryvdh\DomPDF\Facade\Pdf;

class FinanceController extends Controller
{
    protected function getOffice()
    {
        return auth()->user()->office?->office?->accomodation_id;
    }

    public function index()
    {
        $payments = Payment::whereHas('order', function($query){
            $query->where('accomodation_id', $this->getOffice());
        })->with(['user', 'order', 'payable', 'voucher'])->get();

        $bookings = Order::where('accomodation_id', $this->getOffice())->get()->count();

        return view('employee.finance.index')
            ->withPayments($payments)
            ->withBookings($bookings);
    }

    public function paymentDetail(Payment $payment)
    {
        if($payment->order?->accomodation_id != $this->getOffice()){
            abort(403);
        }

        return view('employee.finance.payment_detail')->withPayment($payment->load(['user', 'order', 'payable', 'voucher']));
    }

    public function invoices(Payment $payment)
    {

        if($payment->order?->accomodation_id != $this->getOffice()){
            abort(403);
        }

       $data = $payment->load(['voucher', 'payable', 'user', 'order.accomodation:id,name,address', 'order.room.type:id,name'])->toArray();

        $pdf = Pdf::loadView('admin.finance.invoice', compact('data'));
        return $pdf->stream();
    }

    protected function rupiah($angka){
    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
}
