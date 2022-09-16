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

        $slideimages = [];
        $headings = [];
        $descriptions = [];

        foreach ($sliders as $key => $slider) {
            $slideimages[] = $slider->gambar;
            $headings[] = $slider->heading;
            $descriptions[] = $slider->keterangan;
        }

        return view('profile.index')
            ->withSliders($slideimages)
             ->withHeadingss($headings)
              ->withDescriptions($descriptions);
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
