<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\ForgotPasswordEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class ResendVerifyOtpController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function email(Request $request)
    {
        $request->user()->otp_verify_code = Random::generate(6, 1234567890);

        $request->user()->save();
        
       event(new ForgotPasswordEvent($request->user(), $request));

        return (new UserResource($request->user()))->additional(
            [
                'data' => [
                    'token' => $request->bearerToken(),
                    'message' => 'kami telah mengirimkan kambali kode verifikasi ke email anda',
                    'verifcation_url' => route('api.otp.verification')
                ],
            ]
        );
    }

    public function whatsapp(Request $request)
    {
        $request->user()->otp_verify_code = Random::generate(6, 1234567890);

        $request->user()->save();
        
        event(new ForgotPasswordEvent($request->user(), $request));

        return (new UserResource($request->user()))->additional(
            [
                'data' => [
                    'token' => $request->bearerToken(),
                    'message' => 'kami telah mengirimkan kambali kode verifikasi ke whtasapp anda',
                    'verifcation_url' => route('api.otp.verification')
                ],
            ]
        );
    }
}
