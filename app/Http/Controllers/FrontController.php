<?php

namespace App\Http\Controllers;

use App\Models\aboutAwal;
use App\Models\AboutKedua;
use App\Models\AboutPertama;
use App\Models\Alamat;
use App\Models\documentUnduh;
use App\Models\KeteranganFitur;
use App\Models\Kontak;
use App\Models\Pertanyaan;
use App\Models\ProsesPendaftaran;
use App\Models\Slider;
use App\Models\SliderFitur;
use App\Models\Sosmed;
use App\Models\Syarat;
use App\Models\TambahSlider;
use App\Models\TeamHeader;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        $sliders = TambahSlider::all();
        $aboutPertamas = AboutPertama::all();
        $aboutKeduas = AboutKedua::all();
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        $awals = aboutAwal::all();
        $keteranganFiturs = KeteranganFitur::all();
        $sliderFiturs = SliderFitur::all();
        return view('compro.front.index', [
            'sliders' => $sliders,
            'aboutPertamas' => $aboutPertamas,
            'aboutKeduas' => $aboutKeduas,
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
            'sliderFiturs' => $sliderFiturs,
            'keteranganFiturs' => $keteranganFiturs,
            'awals' => $awals,
        ]);
    }

    public function jadi_mitra() {
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        $sliderMitras = Slider::all();
        $prosesPendaftarans = ProsesPendaftaran::all();
        $syarats = Syarat::all();
        $unduhs = documentUnduh::select('file')->get();
        return view('compro.front.mitra', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
            'sliderMitras' => $kontaks,
            'prosesPendaftarans' => $prosesPendaftarans,
            'syarats' => $syarats,
        ], compact('unduhs'));
    }

    public function hotel() {
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        return view('compro.front.hotel', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
        ]);
    }

    public function tentang() {
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        $teamHeaders = TeamHeader::all();
        $teams = TeamHeader::where('jabatan', 'founder')->first();
        $visis = VisiMisi::where('kategori', 'visi')->get();
        $misis = VisiMisi::where('kategori', 'misi')->get();
        return view('compro.front.team', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
            'teamHeaders' => $teamHeaders,
            'visis' => $visis,
            'misis' => $misis
        ], compact('teams'));
    }

    public function bantuan() {
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        $pertanyaans = Pertanyaan::where('kategori', 'pertanyaan')->get();
        $pertanyaanLains = Pertanyaan::where('kategori', 'lain-lain')->get();
        return view('compro.front.bantuan', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
            'pertanyaans' => $pertanyaans,
            'pertanyaanLains' => $pertanyaanLains,
        ]);
    }

    public function gabung() {
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        return view('compro.front.register', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
        ]);
    }
}
