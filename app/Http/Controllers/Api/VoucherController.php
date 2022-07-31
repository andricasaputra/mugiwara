<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\UserVoucherResource;
use App\Http\Resources\Voucher as ResourcesVoucher;
use App\Models\Customer;
use App\Models\Post;
use App\Models\User;
use App\Models\UserVoucher;
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
        $vouchers = UserVoucher::with(['user', 'voucher' => function($query){
            if(request()->category){
                $query->where('category', request()->category);
            }

            if(request()->search){
                $query->where('name', '', '%' .request()->search. '%' );
            }
        }])
            ->where('user_id', request()->user()->id)
            ->whereNull('is_used')
            ->paginate(request()->take ?? 10);

        $vouchers->appends(request()->all());;

        return UserVoucherResource::collection($vouchers);
    }

    public function userVoucherUsed()
    {
        $vouchers = User::has('voucher')
        ->paginate(request()->take ?? 10);
        $vouchers->appends(request()->all());

        return ResourcesVoucher::collection($vouchers)
                ->additional([
                'status' => 'success',
                'message' => 'List Used Vouchers',
            ]);
    }

    public function userVoucherUnUsed()
    {
        $vouchers = UserVoucher::whereNot('user_id', auth()->id())
        ->paginate(request()->take ?? 10);
        $vouchers->appends(request()->all());

        return ResourcesVoucher::collection($vouchers)
                ->additional([
                'status' => 'success',
                'message' => 'List Used Vouchers',
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
