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

            if($request->wantsJson()){

                return response()->json([
                    'message' => 'Akun anda telah dibanned, Silahkan hubungi administrator'
                ]);

            }else{

                auth()->logout();
                
                return redirect(route('login'))->withErrors('Mohon maaf Akun Anda Telah Dibaneed, Untuk Informasi Lebih Lanjut Hubungi Admin');
            }
        }

        return $next($request);
    }
}
