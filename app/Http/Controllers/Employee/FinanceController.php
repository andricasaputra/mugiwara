<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\SettingFeeCabang;
use App\Models\User;
use App\Models\Withdraw;
use App\Notifications\AdminWithdrawalNotification;
use App\Repositories\BalanceRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Xendit\Xendit;

class FinanceController extends Controller
{
    public $repo;

    public function __construct()
    {
        $this->repo = new BalanceRepository;
        
    }

    protected function getOffice()
    {
        return auth()->user()->office?->office?->accomodation_id;
    }

    protected function setupRepo()
    {
        $this->repo->balanceIn();
        $this->repo->balanceOut();
    }

    public function index()
    {
        $this->setupRepo();

        $payments = Payment::latest()->whereHas('order', function($query){
            $query->where('accomodation_id', $this->getOffice());
        })->with(['user', 'order', 'payable', 'voucher'])->get();

        $bookings = Order::where('accomodation_id', $this->getOffice())->get()->count();

        if(in_array($this->getOffice(), $this->repo->balanceInPerOffice->keys()->toArray())){

             return view('employee.finance.index')
                ->withPayments($payments)
                ->withBookings($bookings)
                ->with('balanceInPerOffice', @$this->repo->balanceInPerOffice[$this->getOffice()] ?? 0)
                ->with('balanceOutPerOffice', $this->repo->balanceOutPerOffice);

        } else {
            return view('employee.finance.index')->withPayments($payments)
                ->withBookings($bookings)->with('balanceInPerOffice', @$this->repo->balanceInPerOffice[$this->getOffice()] ?? 0)
                ->with('balanceOutPerOffice', $this->repo->balanceOutPerOffice);
        }
       
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

        $this->setupRepo();

       $data = $payment->load(['voucher', 'payable', 'user', 'order.accomodation:id,name,address', 'order.room.type:id,name'])->toArray();

        $pdf = Pdf::loadView('admin.finance.invoice', compact('data'));
        return $pdf->stream();
    }

    protected function rupiah($angka){
    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }

    public function createWithdrawBalance()
    {
        if(! auth()->user()->hasRole('admin_cabang')) abort(403);

        $this->setupRepo();

        $available_balance = $this->repo->balanceInPerOffice[$this->getOffice()];

        if($available_balance < 0){
            return redirect(route('employee.finance.index'))->withErrors('Mohon maaf saldo masih 0');
        }

        $fee = SettingFeeCabang::where('office_id', auth()->user()->office?->office?->id)->first();

        return view('employee.finance.withdraw')->withFee($fee);
    }

    public function StoreWithdrawBalance(Request $request)
    {
        if(! auth()->user()->hasRole('admin_cabang')) abort(403);

        $this->setupRepo();

        $request->validate([
            'amount' => 'required|numeric',
            'account_number' => 'required|numeric',
            'bank_name' => 'required'
        ]);

        $balance_in = $this->repo->balanceInPerOffice[$this->getOffice()];

        $total_saldo = $balance_in - $this->repo->balanceOutPerOffice->sum('amount');

        if($total_saldo < $request->amount){
            return redirect(route('employee.finance.index'))->withErrors('Mohon maaf saldo anda tidak mencukupi untuk ditarik, saldo tersedia : Rp ' . $total_saldo);
        }

        $withdraw = Withdraw::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'fee_amount' => $request->fee_amount,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
        ]);

        $admin = User::admin()->first();

        $title = "Terdapat Permohonan Penarikan Saldo Dari Kantor Cabang";

        event(new \App\Events\WithdrawBroadcastEvent($title));

        $admin->notify(new AdminWithdrawalNotification($withdraw, $title));

        return redirect(route('employee.finance.index'))->withSuccess('Berhasil mengirim permohonan withdraw saldo, mohon untuk menunggu verifikasi dari admin pusat');
    }
}
