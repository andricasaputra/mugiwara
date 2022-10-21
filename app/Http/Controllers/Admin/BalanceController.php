<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BalanceRepository;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function __construct(protected BalanceRepository $repository)
    {
    }

    public function index()
    {
        $this->repository->balanceIn();

        return view('admin.finance.saldo.index')
            ->with('balance_in_total', $this->repository->balanceInTotal)
            ->with('balance_in_total_per_office', $this->repository->balanceInPerOffice);
    }

    
}
