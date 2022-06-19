<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileNumberVerificationNotificationController extends Controller
{
     /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $home = $request->user()->hasRole('admin') 
                ? RouteServiceProvider::ADMINHOME
                : RouteServiceProvider::HOME;

        if ($request->user()->hasVerifiedMobileNumber()) {
            return redirect()->intended($home);
        }

        $request->user()->sendMobileNumberVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
