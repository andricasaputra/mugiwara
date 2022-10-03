<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DeletedUser
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
        if ($request->user()->deleted_at != null) {

            if (! $request->expectsJson()) {
                return route('login');
            }

            return response()->json([
                'message' => 'unauthenticated'
            ]);
        }

        return $next($request);
    }
}
