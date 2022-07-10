<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendVerifyMobileNumber;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class VerifyMobileController extends Controller
{
    /*
    * Create verify request
    */
    public function create(Request $request)
    {
        if(! is_null($request->user()->mobile_verify_at)){
            return response()->json([
                'message' => 'Nomor telepon anda sudah terverifikasi'
            ], 403);
        }

        $generateOtp = Random::generate(6, 1234567890);

        $request->user()->update([
            'mobile_verify_code' => $generateOtp
        ]);

        $user  = $request->user()->fresh();

        $user->notify(new SendVerifyMobileNumber($user));

        return response()->json([
            'message' => 'Kode otp telah kami kirimkan ke nomor hp anda via whatsapp'
        ], 200);
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyOtpCode(Request $request)
    {
        $request->validate([
            'mobile_verify_code' => 'required|numeric'
        ]);

        $otp = $request->user()->mobile_verify_code;

        if($otp != $request->mobile_verify_code){
            return response()->json([
                'message' => 'kode otp yang anda masukkan tidak valid'
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
                'id', 'email', 'name', 'email_verified_at', 'mobile_verified_at'
            ]),
            'message' => 'Verifikasi nomor hp berhhasil'
        ]);
    }
}
