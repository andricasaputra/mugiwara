<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\TambahSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = TambahSlider::all();

        return view('profile.index')
            ->withSliders($sliders);
    }

    public function mitra()
    {
        return view('profile.mitra');
    }

    public function hotel()
    {
        return view('profile.hotel');
    }

    public function tentang()
    {
        return view('profile.team');
    }

    public function bantuan()
    {
        return view('profile.bantuan');
    }
}
