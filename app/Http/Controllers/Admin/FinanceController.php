<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
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
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        $this->repo = new BalanceRepository;
    }

    protected function setupRepo()
    {
        $this->repo->balanceIn();
        $this->repo->balanceOut();
    }

    public function index()
    {
        $this->setupRepo();

        $payments = Payment::latest()->with(['user', 'order', 'payable', 'voucher'])->get();

        $getBalance = $this->getBalance();

        $bookings = Order::get()->count();

        return view('admin.finance.index')
            ->withPayments($payments)
            ->withBookings($bookings)
            ->with('balance_xendit', $this->rupiah($getBalance['balance']))
            ->with('balance_in_total', $this->repo->balanceInTotal)
            ->with('balance_out_total', $this->repo->balanceOutTotal);
    }

    public function paymentDetail(Payment $payment)
    {
        return view('admin.finance.payment_detail')->withPayment($payment->load(['user', 'order', 'payable', 'voucher']));
    }

    public function getBalance()
    {
        return \Xendit\Balance::getBalance('CASH');
    }

    public function transaction($pages = 1, $link = null)
    {
        $params = [
            'types' => 'PAYMENT',
            'query-param'=> 'true' 
        ];

        $transactions = \Xendit\Transaction::list($params);
        $prevLink = NULL;
        $nextLink = url(route('admin.finance.transaction.list', [$pages + 1, substr($transactions['links'][0]['href'], 1)]));

        if ($link != null) {


            $params = $link . '?currency=' . request()->currency . '&limit=' . request()->limit . '&after_id=' . request()->after_id;

            $username = env('XENDIT_SECRET_KEY') . ":";
            $password = "";

            $response = Http::accept('application/json')
                ->withBasicAuth($username, $password)->get('https://api.xendit.co/' . $params);

            if ($pages - 1 == 0) {

                $prevLink = NULL;

            } else {

                $prevLink = url(route('admin.finance.transaction.list', [$pages - 1, substr($transactions['links'][0]['href'], 1)]));

            }
            
            $nextLink = url(route('admin.finance.transaction.list', [$pages + 1, substr($transactions['links'][0]['href'], 1)]));
        

            $transactions = json_decode($response->body(), true);
        }

        return view('admin.finance.transaction')
            ->withTransactions($transactions)
            ->withPrevlink($prevLink)
            ->withNextlink($nextLink)
            ->withPages($pages);
    }

    public function transactionDetail($transaction_id)
    {
        $detailTransaction = \Xendit\Transaction::detail($transaction_id);

        return view('admin.finance.transaction_detail')->withTransaction($detailTransaction);
    }

    public function invoices(Payment $payment)
    {
        $data = $payment->load(['voucher', 'payable', 'user', 'order.accomodation:id,name,address', 'order.room.type:id,name'])->toArray();

        $pdf = Pdf::loadView('admin.finance.invoice', compact('data'));
        return $pdf->stream();
    }

    protected function rupiah($angka){
    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
}
