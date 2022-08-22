<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendVerifyMobileNumber;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class VerifyMobileController extends Controller
{

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|numeric'
        ]);

        if($request->mobile_number != $request->user()->mobile_number){
            return response()->json([
                'message' => 'Nomor telepon anda tidak sesuai dengan nomor yang terdaftar di aplikasi kami'
            ]);
        }

        if ($request->user()->hasVerifiedMobileNumber()) {
            return response()->json([
                'message' => 'Nomor telepon anda telah di verifikasi'
            ]);
        }

        $request->user()->markMobileNumberAsVerified();

        return response()->json([
            'data' => $request->user()->only([
                'id', 'email', 'name', 'mobile_verified_at'
            ]),
            'message' => 'Verifikasi nomor hp berhhasil'
        ]);
    }

    protected function numberFormat($user)
    {
        $number = $user->mobile_number;
        $number = str_replace(' ', '-', $number);
        $number = preg_replace("/[^0-9\-]+/", "", $number);

        $first_character = substr($number, 0, 1);

        if($first_character == 0 || $first_character == '0'){
            $number = substr_replace($number, "62", 0, 1);
        }

        return $number;
    }
}
