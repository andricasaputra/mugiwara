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

        try{

            DB::beginTransaction();

            $voucher = Voucher::find($request->voucher_id);

            $account = $request->user()->account;

            $userVouchers = $request->user()->vouchers;

            // check kecukupan poin user
            if($voucher->point_needed > $account->point){
                return response()->json([
                    'status' => 'error',
                    'data' => [
                        'user_point' => $account->point,
                        'voucher_point' =>  (int) $voucher->point_needed
                    ],
                    'message' => 'Poin anda tidak cukup untuk menukarkan voucher ini',
                ], 400);
            }

            // check voucher sudah pernah ditukarkan atau belum
            if(in_array($voucher->id, $userVouchers->pluck('id')->all()) ){
                return response()->json([
                    'status' => 'error',
                    'data' => [
                        'user_voucher' => $userVouchers->pluck('name'),
                        'voucher' => $voucher->name 
                    ],
                    'message' => 'Poin anda tidak cukup untuk menukarkan voucher ini',
                ], 400);
            }

            if($voucher->discount_type == 'percent'){
                $discount_amount = $account->point * $voucher->point_needed;
            } else{
                $discount_amount = $voucher->point_needed;
            }

            $pointAfter = $account->point - $discount_amount;
        
            $accountPoin = AccountPoint::create([
                'user_id' => $request->user()->id,
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
            'data' => $account->load('voucher'),
            'message' => 'success',
        ], 201);
    }
}
