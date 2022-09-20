<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use App\Models\Alamat;
use App\Models\AppStoreLink;
use App\Models\Beranda;
use App\Models\BerandaOverview;
use App\Models\GeneralSettings;
use App\Models\Image;
use App\Models\MitraGabung;
use App\Models\MitraSection;
use App\Models\Pendaftaran;
use App\Models\Pertanyaan;
use App\Models\PlayStoreLink;
use App\Models\SliderFitur;
use App\Models\SliderMitra;
use App\Models\SyaratDokumen;
use App\Models\Tambah_menu_compro;
use App\Models\TambahBerandaInformasi;
use App\Models\TambahSlider;
use App\Models\TambahSliderTentang;
use App\Models\TeamHeader;
use App\Models\Type;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $overview = BerandaOverview::orderBy('order', 'asc')->get();
        $settings = GeneralSettings::first();
        

        return view('profile.index', [
            'title' => 'Beranda',
            'beranda' => $beranda,
            'settingPlayStore' => $settingPlayStore,
            'settingAppStore' => $settingAppStore,
            'fitur' => $fitur,
            'sliderTentang' => $sliderTentang,
            'informasi' => $informasi,
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'overview' => $overview
        ])
            ->withSliders($sliders);
    }

    public function mitra()
    {
        $menu = Tambah_menu_compro::all();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $mitraSection = MitraSection::all();
        $sliderMitra = SliderMitra::all();
        $pendaftaran = Pendaftaran::orderBy('order', 'asc')->get();
        $syarat = SyaratDokumen::orderBy('order', 'asc')->get();
        $settings = GeneralSettings::first();
        return view('profile.mitra', [
            'title' => 'Jadi Mitra',
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'mitraSection' => $mitraSection,
            'sliderMitra' => $sliderMitra,
            'pendaftaran' => $pendaftaran,
            'syarat' => $syarat
        ]);
    }

    public function hotel()
    {
        $menu = Tambah_menu_compro::all();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $kategori = Type::all();
        $accomodationTopRate = DB::table('accomodation_ratings')
        ->select(DB::raw('accomodation_id, avg(rating) as avgRating'))
        ->groupBy('accomodation_id')
        ->orderBy('avgRating', 'desc')
        ->first();
        $accomodationTop = null;
        $accomodationTopImage = null;
        if (!is_null($accomodationTopRate)) {
            $accomodationTop = Accomodation::find($accomodationTopRate->accomodation_id);
            $accomodationTopImage = Image::where('imageable_id', $accomodationTop->id)->where('imageable_type', Accomodation::class)->first();
        }
        $settings = GeneralSettings::first();
        return view('profile.hotel', [
            'title' => 'Hotel',
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'kategori' => $kategori,
            'accomodationTop' => $accomodationTop,
            'accomodationTopRate' => $accomodationTopRate,
            'accomodationTopImage' => $accomodationTopImage
        ]);
    }

    public function tentang()
    {
        $menu = Tambah_menu_compro::all();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $visiMisi = VisiMisi::all();
        $team = TeamHeader::all();
        $settings = GeneralSettings::first();
        return view('profile.team', [
            'title' => 'Tentang Kami',
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'visiMisi' => $visiMisi,
            'team' => $team
        ]);
    }

    public function bantuan()
    {
        $menu = Tambah_menu_compro::all();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $pertanyaan = Pertanyaan::where('kategori', 'pertanyaan')->limit(7)->get();
        $lainnya = Pertanyaan::where('kategori', 'lain-lain')->limit(7)->get();
        $settings = GeneralSettings::first();
        return view('profile.bantuan', [
            'title' => 'Bantuan',
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'pertanyaan' => $pertanyaan,
            'lainnya' => $lainnya
        ]);
    }

    public function detailInformasi($id)
    {
        $menu = Tambah_menu_compro::all();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $informasi = TambahBerandaInformasi::find($id);
        $settings = GeneralSettings::first();
        return view('profile.detail_informasi', [
            'title' => 'Beranda - Informasi',
            'settings' => $settings,
            'menu' => $menu,
            'informasi' => $informasi,
            'alamat' => $alamat,
        ]);
    }

    public function roomCheck(Request $request)
    {
        return response()->json($request->date);
    }

    public function accomodationTop(Request $request)
    {
        $accomodationTopRate = DB::table('accomodation_ratings')
        ->select(DB::raw('accomodation_id, avg(rating) as avgRating'))
        ->groupBy('accomodation_id')
        ->orderBy('avgRating', 'desc')
        ->get();
        $accomodationId = [];
        if (count($accomodationTopRate)!=0) {
            foreach($accomodationTopRate as $k => $a) {
                $accomodationId[] = $a->accomodation_id;
            }
        }
        $accomodationById = Accomodation::whereIn('id', $accomodationId)->with('ratings')->get();
        return response()->json([
            'accomodationTopRate' => $accomodationTopRate,
            'accomodationId' => $accomodationId,
            'accomodationById' => $accomodationById
        ]);
    }

    public function pertanyaanDetail($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $menu = Tambah_menu_compro::all();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $settings = GeneralSettings::first();
        return view('profile.detail_pertanyaan', [
            'title' => 'Pertanyaan',
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'pertanyaan' => $pertanyaan
        ]);
    }
}
