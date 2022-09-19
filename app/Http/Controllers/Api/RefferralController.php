<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountPoint;
use App\Models\Affiliate;
use App\Models\Customer;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\ReferralCodeUsedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Nette\Utils\Random;

class RefferralController extends Controller
{
    public function redeem(Request $request)
    {
        DB::beginTransaction();

        try {

             $request->validate([
                'refferral_code' => 'required',
                'device_id' => 'required',
            ]);

            $user_efferral = $request->user()?->account?->refferral_code;

            if($user_efferral == $request->refferral_code){
                return response()->json([
                    'message' => 'Tidak dapat menukarkan kode refferral diri sendiri'
                ]);
            }

            // akun pemilik kode refferral
            $account = Account::where('refferral_code', $request->refferral_code)->first();

            if (! $account) {
                return response()->json([
                    'message' => 'Kode Refferral TIdak Ditemukan'
                ]);
            }

            $check = Affiliate::where('user_id',  $request->user()?->id)->first();

            if($check){
                return response()->json([
                    'message' => 'Anda tidak dapat lagi menukarkan kode refferral'
                ]);
            }

            $deviceCheck = Affiliate::where('device_id', $request->device_id)->first();

            if($deviceCheck){
                 return response()->json([
                    'message' => 'Anda tidak dapat lagi menukarkan kode refferral dengan device ini'
                ]);
            }

            $affilliate = Affiliate::create([
                'user_id' => $request->user()->id,
                'refferal_code' => $request->refferral_code,
                'device_id' => $request->device_id
            ]);

            $followers = $affilliate->followers()->create([
                'affiliates_id' =>  $affilliate ->id,
                'user_id' => $account->user?->id
            ]);


            $acc1 = Account::where('user_id', $request->user()->id)->first();
            $acc2 = Account::where('id', $account->id)->first();

            $point = Setting::where('name', 'point_refferral')->where('is_active', 1)->first();

            if(! $point){
                $point = 0;
            } else {
                $point = $point->value;
            }

            $pointBefore1 = $acc1->point;
            $pointBefore2 = $acc2->point;

            $pointAfter1 = $pointBefore1 + $point;
            $pointAfter2 = $pointBefore2 + $point;

            $acc1->update([
                'point' => $pointAfter1
            ]);

            $acc2->update([
                'point' => $pointAfter2
            ]);

             AccountPoint::insert([
               [
                    'user_id' => $request->user()->id,
                    'affiliate_id' => $affilliate->id,
                    'before' => $pointBefore1,
                    'after' => $pointAfter1,
                    'mutation' => $point,
                    'type' => 'point_in',
                    'description' => 'penukaran kode refferral',
                    'transaction_number' => 'Trxp-' . Random::generate(15, 1234567890),
                    'created_at' => now()
               ],
               [
                    'user_id' => $account->user?->id,
                    'affiliate_id' => $affilliate->id,
                    'before' => $pointBefore2,
                    'after' => $pointAfter2,
                    'mutation' => $point,
                    'type' => 'point_in',
                    'description' => 'penukaran kode refferral',
                    'transaction_number' => 'Trxp-' . Random::generate(15, 1234567890),
                    'created_at' => now()
               ],
            ]);
            
            $user1 = User::find($account->user?->id);
            $customer1 = Customer::find($account->user?->id);

            $user2 = User::find($request->user()->id);
            $customer2 = Customer::find($request?->user()?->id);

            Notification::send($user1, new ReferralCodeUsedNotification('Selamat anda mendapatkan tambahan poin senilai ' . $point . ' dari pemakaian kode refferral ' . $request->refferral_code));

            Notification::send($customer1, new ReferralCodeUsedNotification('Selamat anda mendapatkan tambahan poin senilai ' . $point . ' dari pemakaian kode refferral ' . $request->refferral_code));

            Notification::send($user2, new ReferralCodeUsedNotification('Selamat anda mendapatkan tambahan poin senilai ' . $point . ' dari pemakaian kode refferral ' . $request->refferral_code));

            Notification::send($customer2, new ReferralCodeUsedNotification('Selamat anda mendapatkan tambahan poin senilai ' . $point . ' dari pemakaian kode refferral ' . $request->refferral_code));

            DB::commit();

            return response()->json([
                'message' => 'Success, selamat anda mendapatkan ' . $point . ' poin'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
       
    }

    public function getPointValue()
    {
        $point_refferral = Setting::where('type', 'point')->where('name', 'point_refferral')->first();

        $point_menginap = Setting::where('type', 'point')->where('name', 'point_menginap')->first();

        return response()->json([
            'data' => [
                'point_refferral' => $point_refferral,
                'point_menginap' => $point_menginap
            ]
        ]);
    }
}
