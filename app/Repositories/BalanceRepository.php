<?php  

namespace App\Repositories;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Withdraw;

class BalanceRepository
{
	public $balanceInTotal;
    public $balanceOutTotal;
    public $balanceInPerOffice;
    public $balanceOutPerOffice;
    public $totalBalance;

	public function balanceIn()
    {
        $orders = Order::whereHas('payment', function($query){
            $query->where('status', 'COMPLETED')
            ->orWhere('status', 'SUCCEEDED');
        })->with('payment')->get();

        $this->balanceInTotal = Payment::where('status', 'COMPLETED')
            ->orWhere('status', 'SUCCEEDED')->get()->sum('amount');

        $this->balanceInPerOffice = $orders->groupBy('accomodation_id')->map(function($p, $key){
            return $p->sum('payment.amount');
        });
    }

    public function balanceOut()
    {
        $this->balanceOutPerOffice = Withdraw::where('accomodation_id', auth()->user()->office?->office?->accomodation_id)->where('status', 'APPROVED')->get();

        $this->balanceOutTotal = Withdraw::where('status', 'APPROVED')->get();
    }
}