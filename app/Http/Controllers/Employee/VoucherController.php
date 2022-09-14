<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->when(request()->q, function($vouchers) {
            $vouchers->where('name', 'like', '%'.request()->q.'%')->orWhere('description', 'like', '%'.request()->q.'%');
        })->latest()->get();

        return view('employee.voucher.index', compact('vouchers'));
    }

    public function show($voucherId)
    {
        $voucher = Voucher::find($voucherId);
        return view('employee.voucher.show', compact('voucher'));
    }

    public function redeemList()
    {
        $vouchers = UserVoucher::latest()->with(['voucher.accountPoints', 'user'])->get();

        return view('admin.voucher.redeem_list.index', compact('vouchers'));
    }

}
