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
        $posts = Voucher::paginate(10);
        $posts = ResourcesVoucher::collection($posts);
        return response()->json([
            'status' => 'success',
            'message' => 'List Vouchers',
            'data' =>  $posts->response()->getData(true),
        ], 200);
    }
}
