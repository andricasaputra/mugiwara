<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsEmployee
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
        abort_if(! auth()->user()->hasRole('admin_cabang')
            || ! auth()->user()->hasRole('employee'), 403);

        return $next($request);
    }
}
