<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountPoint;
use App\Models\Affiliate;
use App\Models\Customer;
use App\Models\Setting;
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

            $affilliate->affiliatesUser()->create([
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

            $acc1->update([
                'point' => $acc1->point + $point
            ]);

            $acc2->update([
                'point' => $acc2->point + $point
            ]);

             AccountPoint::insert([
               [
                    'user_id' => $request->user()->id,
                    'affiliate_id' => $affilliate->id,
                    'before' => $acc1->point,
                    'after' => $acc1->point + $point,
                    'mutation' => $point,
                    'type' => 'point_in',
                    'description' => 'penukaran kode refferral',
                    'transaction_number' => 'Trxp-' . Random::generate(15, 1234567890),
                    'created_at' => now()
               ],
               [
                    'user_id' => $account->user?->id,
                    'affiliate_id' => $affilliate->id,
                    'before' => $acc2->point,
                    'after' => $acc2->point + $point,
                    'mutation' => $point,
                    'type' => 'point_in',
                    'description' => 'penukaran kode refferral',
                    'transaction_number' => 'Trxp-' . Random::generate(15, 1234567890),
                    'created_at' => now()
               ],
            ]);
            
            $customer = Customer::find($account->user?->id);

            Notification::send($request->user(), new ReferralCodeUsedNotification('Selamat anda mendapatkan tambahan poin senilai ' . $point . ' dari pemakaian kode refferral ' . $request->refferral_code));

            Notification::send($customer, new ReferralCodeUsedNotification('Selamat anda mendapatkan tambahan poin senilai ' . $point . ' dari pemakaian kode refferral ' . $request->refferral_code));

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
}
