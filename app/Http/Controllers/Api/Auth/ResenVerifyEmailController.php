<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class ResenVerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $request->user()->otp_verify_code = Random::generate(6, 1234567890);

        $request->user()->save();
        
        event(new Registered($request->user()));

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
}
