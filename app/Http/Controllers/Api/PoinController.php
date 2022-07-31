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
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Notifications\PointRedeemSuccessNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

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

             if(! $voucher){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Voucher tidak ditemukan',
                ], 404);
            }

            $account = $request->user()->account;

            if(! $account){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun tidak ditemukan',
                ], 404);
            }

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
            if(in_array($voucher->id, $userVouchers?->pluck('id')->all()) ){
                return response()->json([
                    'status' => 'error',
                    'data' => [
                        'user_voucher' => $userVouchers?->pluck('name'),
                        'voucher' => $voucher->name 
                    ],
                    'message' => 'Anda sudah pernah menukarkan voucher ini',
                ], 400);
            }

            if($voucher->discount_type == 'percent'){
                $discount_amount = $account->point * $voucher->point_needed;
            } else{
                $discount_amount = $voucher->point_needed;
            }

            $uVoucher = UserVoucher::create([
                'user_id' => $request->user()->id,
                'voucher_id' => $request->voucher_id,
                'is_used' => NULL
            ]);

            $pointAfter = $account->point - $discount_amount;
        
            $accountPoin = AccountPoint::create([
                'user_id' => $request->user()->id,
                'voucher_id' => $request->voucher_id,
                'before' => $account->point,
                'after' => $pointAfter,
                'transaction_number' => 'Trxp' . Random::generate(15, 1234567890),
            ]);

            $account->update([
                'point' => $pointAfter
            ]);

            $request->user()->notify(
                new PointRedeemSuccessNotification($accountPoin, $voucher)
            );

            DB::commit();

        }catch(\Exception $e){

            DB::rollback();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() . ' ' .  $e->getLine(),
            ], 400);
        }

        return response()->json([
            'data' => $accountPoin->load('voucher'),
            'message' => 'success',
        ], 201);
    }
}
