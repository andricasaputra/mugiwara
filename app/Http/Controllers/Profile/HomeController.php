<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\AppStoreLink;
use App\Models\Beranda;
use App\Models\MitraGabung;
use App\Models\PlayStoreLink;
use App\Models\SliderFitur;
use App\Models\TambahBerandaInformasi;
use App\Models\TambahSlider;
use App\Models\TambahSliderTentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = TambahSlider::all();
        $beranda = Beranda::all();
        $settingPlayStore = PlayStoreLink::orderBy('created_at', 'desc')->first();
        $settingAppStore = AppStoreLink::orderBy('created_at', 'desc')->first();
        $fitur = SliderFitur::all();
        $sliderTentang = TambahSliderTentang::limit(6)->get();
        $informasi = TambahBerandaInformasi::all();
        

        return view('profile.index', [
            'title' => 'Beranda',
            'beranda' => $beranda,
            'settingPlayStore' => $settingPlayStore,
            'settingAppStore' => $settingAppStore,
            'fitur' => $fitur,
            'sliderTentang' => $sliderTentang,
            'informasi' => $informasi
        ])
            ->withSliders($sliders);
    }

    public function mitra()
    {
        return view('profile.mitra', [
            'title' => 'Jadi Mitra'
        ]);
    }

    public function hotel()
    {
        return view('profile.hotel', [
            'title' => 'Hotel'
        ]);
    }

    public function tentang()
    {
        return view('profile.team', [
            'title' => 'Tentang Kami'
        ]);
    }

    public function bantuan()
    {
        return view('profile.bantuan', [
            'title' => 'Bantuan'
        ]);
    }
}
