<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request)
    {
        $home = $request->user()->hasRole('admin') 
                ? RouteServiceProvider::ADMINHOME
                : RouteServiceProvider::HOME;
        
        if ($request->user()->hasVerifiedEmail()) {

            return redirect($home)->withErrors('Email Anda Sudah Terverifikasi Silahkan Login');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect($home)->withSuccess('Selamat Verifikasi Email Sukses!');
    }

    public function resend(Request $request)
    {
        auth()->user()->notify(new VerifyEmail);

        return back()->with('status', 'verification-link-sent');
    }
}
