<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Affiliate;
use App\Models\Customer;
use App\Notifications\ReferralCodeUsedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class RefferralController extends Controller
{
    public function redeem(Request $request)
    {
        $request->validate([
            'refferral_code' => 'required'
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

        //dd($account->point);

        $affilliate = Affiliate::create([
            'user_id' => $request->user()->id,
            'refferal_code' => $request->refferral_code
        ]);

        $affilliate->affiliatesUser()->create([
            'affiliates_id' =>  $affilliate ->id,
            'user_id' => $account->user?->id
        ]);

        $acc1 = Account::where('user_id', $request->user()->id)->first();
        $acc2 = Account::where('id', $account->id)->first();

        $acc1->update([
            'point' => $acc1->point + 60000
        ]);

        $acc2->update([
            'point' => $acc2->point + 60000
        ]);

        // $request->user()->account->point += 60000;
        // $request->user()->account->save();

        // $account->point += 60000;
        // $account->save();

        $customer = Customer::find($account->user?->id);

        Notification::send($request->user(), new ReferralCodeUsedNotification('Selamat anda mendapatkan tambahan poin senilai ' . 60000 . ' dari pemakaian kode refferral ' . $request->refferral_code));

        Notification::send($customer, new ReferralCodeUsedNotification('Selamat anda mendapatkan tambahan poin senilai ' . 60000 . ' dari pemakaian kode refferral ' . $request->refferral_code));

        return response()->json([
            'message' => 'Success, selamat anda mendapatkan ' . 60000 . ' poin'
        ]);
    }
}
