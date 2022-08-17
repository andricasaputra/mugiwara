<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Xendit\Xendit;

class FinanceController extends Controller
{

    public function __construct()
    {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
    }

    public function index()
    {
        $payments = Payment::with(['user', 'order', 'payable', 'voucher'])->get();

        $getBalance = $this->getBalance();

        $bookings = Order::get()->count();

        return view('admin.finance.index')
            ->withPayments($payments)
            ->withBookings($bookings)
            ->withBalance($this->rupiah($getBalance['balance']));
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

    public function allInvoices()
    {
        $getAllInvoice = \Xendit\Invoice::retrieveAll();
        dd(($getAllInvoice));

        return view('admin.finance.invoice.index')->withTransaction($detailTransaction);
    }

    protected function rupiah($angka){
    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
}
