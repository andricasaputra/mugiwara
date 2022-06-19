<?php

namespace App\Http\Middleware;

use App\Contracts\MustVerifyMobileNumber;
use Closure;
use Illuminate\Http\Request;

class EnsureMobileNumberIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyMobileNumber &&
            ! $request->user()->hasVerifiedMobileNumber())) {

            if(is_null($request->user()->mobile_verify_code)){
                $request->user()->sendMobileNumberVerificationNotification();
            }

            return redirect(route('verification.mobile.verify', auth()->user()->getKey()));
        }

        return $next($request);
    }
}
