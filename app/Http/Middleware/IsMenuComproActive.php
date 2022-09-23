<?php

namespace App\Http\Middleware;

use App\Models\Tambah_menu_compro;
use Closure;
use Illuminate\Http\Request;

class IsMenuComproActive
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
        $menus = Tambah_menu_compro::all();

        foreach($menus as $menu){
            if($menu->status == 0 && $request->url() == $menu->url_menu){
                return view('errors.compro.compro-404');
            }
        }

        return $next($request);
    }
}
