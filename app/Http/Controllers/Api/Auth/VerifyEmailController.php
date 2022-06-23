<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        
        $otp = $request->user()->otp_verify_code;

        if($otp != $request->otp_code){
            return response()->json([
                'message' => 'Kode OTP tidak sesuai'
            ], 403);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return (new UserResource($request->user()))->additional(
                [
                    'data' => [
                        'message' => 'email anda sudah terverifikasi',
                    ],
                ]
            );
        }

        $request->user()->markEmailAsVerified();

        return (new UserResource($request->user()))->additional(
            [
                'data' => [
                    'token' => $request->bearerToken(),
                    'message' => 'verifikasi email sukses',
                ],
            ]
        );
    }
}
