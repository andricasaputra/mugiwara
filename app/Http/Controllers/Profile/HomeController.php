<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\AppStoreLink;
use App\Models\Beranda;
use App\Models\MitraGabung;
use App\Models\MitraSection;
use App\Models\Pendaftaran;
use App\Models\PlayStoreLink;
use App\Models\SliderFitur;
use App\Models\SliderMitra;
use App\Models\SyaratDokumen;
use App\Models\Tambah_menu_compro;
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
        $menu = Tambah_menu_compro::where('status', 1)->get();
        

        return view('profile.index', [
            'title' => 'Beranda',
            'beranda' => $beranda,
            'settingPlayStore' => $settingPlayStore,
            'settingAppStore' => $settingAppStore,
            'fitur' => $fitur,
            'sliderTentang' => $sliderTentang,
            'informasi' => $informasi,
            'menu' => $menu
        ])
            ->withSliders($sliders);
    }

    public function mitra()
    {
        $menu = Tambah_menu_compro::all();
        $mitraSection = MitraSection::all();
        $sliderMitra = SliderMitra::all();
        $pendaftaran = Pendaftaran::orderBy('order', 'asc')->get();
        $syarat = SyaratDokumen::orderBy('order', 'asc')->get();
        return view('profile.mitra', [
            'title' => 'Jadi Mitra',
            'menu' => $menu,
            'mitraSection' => $mitraSection,
            'sliderMitra' => $sliderMitra,
            'pendaftaran' => $pendaftaran,
            'syarat' => $syarat
        ]);
    }

    public function hotel()
    {
        $menu = Tambah_menu_compro::all();
        return view('profile.hotel', [
            'title' => 'Hotel',
            'menu' => $menu
        ]);
    }

    public function tentang()
    {
        $menu = Tambah_menu_compro::all();
        return view('profile.team', [
            'title' => 'Tentang Kami',
            'menu' => $menu
        ]);
    }

    public function bantuan()
    {
        $menu = Tambah_menu_compro::all();
        return view('profile.bantuan', [
            'title' => 'Bantuan',
            'menu' => $menu
        ]);
    }

    public function detailInformasi($id)
    {
        $menu = Tambah_menu_compro::all();
        $informasi = TambahBerandaInformasi::find($id);
        return view('profile.detail_informasi', [
            'title' => 'Beranda - Informasi',
            'menu' => $menu,
            'informasi' => $informasi
        ]);
    }
}
