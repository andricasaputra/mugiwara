<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Point as ResourcesPoint;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\Voucher as ResourcesVoucher;
use App\Models\Account;
use App\Models\AccountPoint;
use App\Models\Point;
use App\Models\Post;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoinController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'voucher_id' => 'required',
        ]);
        // dd($request->all());
        $voucher = Voucher::find($request->voucher_id);
        $account = Account::where('user_id', 8)->first();
        if($voucher->point_needed > $account->point){
            return response()->json([
                'status' => 'error',
                'message' => 'Poin Akun kurang dari poin voucher',
            ], 400);
        }
        $pointAfter = $account->point - $voucher->point_needed;
        try{
            DB::beginTransaction();
            $accountPoin = AccountPoint::create([
                'user_id' => 8,
                'voucher_id' => $request->voucher_id,
                'before' => $account->point,
                'after' => $pointAfter,
            ]);
            $account->update([
                'point' => $pointAfter
            ]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
        return response()->json([
            'message' => 'success',
        ], 201);
    }
}
