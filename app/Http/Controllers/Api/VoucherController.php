<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\Voucher as ResourcesVoucher;
use App\Models\Customer;
use App\Models\Post;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    // Semua voucher yang belum pernah user claim
    public function index()
    {
        $vouchers = Voucher::doesntHave('account')->isActive()->when(request()->category, function($vouchers) {
            $vouchers->where('category', request()->category);
        })->paginate(request()->take ?? 10);

        $vouchers->appends(request()->all());

        return ResourcesVoucher::collection($vouchers)
                ->additional([
                'status' => 'success',
                'message' => 'List Vouchers that not claimed by user',
            ]);
    }

    // Detail voucher
    public function show($id)
    {
        $voucher = Voucher::isActive()->findOrFail($id);
        $voucher = new ResourcesVoucher($voucher);
        return $voucher
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Voucher',
                ]);
    }

    // User voucher
    public function userVoucher()
    {
        $vouchers = User::findOrFail(request()->user()->id)->vouchers()->when(request()->category, function($vouchers) {
            $vouchers->where('category', request()->category);
        })
        ->when(request()->search, function($vouchers) {
            $vouchers->where('name', '', '%' .request()->search. '%' );
        })
        ->paginate(request()->take ?? 10);
        $vouchers->appends(request()->all());

        return ResourcesVoucher::collection($vouchers)
                ->additional([
                'status' => 'success',
                'message' => 'List User Vouchers',
            ]);
    }

    // Semua voucher
    public function allVouchers()
    {
        $vouchers = Voucher::isActive()->when(request()->category, function($vouchers) {
            $vouchers->where('category', request()->category);
        })
        ->paginate(request()->take ?? 10);
        $vouchers->appends(request()->all());
        return ResourcesVoucher::collection($vouchers)
                ->additional([
                'status' => 'success',
                'message' => 'All Vouchers',
            ]);
    }
}
