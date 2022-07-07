<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\Voucher as ResourcesVoucher;
use App\Models\Post;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::paginate(10);
        return ResourcesVoucher::collection($vouchers)
                ->additional([
                'status' => 'success',
                'message' => 'List Vouchers',
            ]);
    }
    public function show($id)
    {
        $voucher = Voucher::find($id);
        $voucher = new ResourcesVoucher($voucher);
        return $voucher
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Voucher',
                ]);
    }
}
