<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class VerifyMobileController extends Controller
{
    public function index()
    {
        return view('auth.verify-mobile');
    } 

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $otp = auth()->user()->mobile_verify_code;

        if($otp != $request->otp){
            return back()->withErrors('Kode OTP tidak sesuai');
        }

        $home = $request->user()->hasRole('admin') 
                ? RouteServiceProvider::ADMINHOME
                : RouteServiceProvider::HOME;

        if ($request->user()->hasVerifiedMobileNumber()) {
            return redirect()->intended($home.'?mobile_verified=1');
        }

        $request->user()->markMobileNumberAsVerified();

        return redirect()->intended($home.'?mobile_verified=1');
    }
}
