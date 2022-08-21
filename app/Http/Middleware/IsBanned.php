<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBanned
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
        if(! is_null(auth()->user()->banned)){
            return response()->json([
                'message' => 'Akun anda telah dibanned, Silahkan hubungi administrator'
            ]);
        }

        return $next($request);
    }
}
