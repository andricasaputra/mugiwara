<?php

namespace App\Http\Controllers;

use App\Models\aboutAwal;
use App\Models\AboutKedua;
use App\Models\AboutPertama;
use App\Models\Accomodation;
use App\Models\Alamat;
use App\Models\documentUnduh;
use App\Models\KeteranganFitur;
use App\Models\Kontak;
use App\Models\Pertanyaan;
use App\Models\Post;
use App\Models\ProsesPendaftaran;
use App\Models\Review;
use App\Models\Room;
use App\Models\Slider;
use App\Models\SliderFitur;
use App\Models\Sosmed;
use App\Models\Syarat;
use App\Models\TambahSlider;
use App\Models\TeamHeader;
use App\Models\Tombol;
use App\Models\Type;
use App\Models\User;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\For_;

use function PHPSTORM_META\type;

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
        $data_jumlah_mitras = Accomodation::count();
        $data_jumlah_users = User::count();
        $data_jumlah_customers = User::where('type', 'customer')->count();
        $reviews = DB::table('reviews')
                    ->join('rooms', 'rooms.id', '=', 'reviews.reviewable_id')
                    ->join('users', 'reviews.user_id', '=', 'users.id')
                    ->join('accounts', 'accounts.user_id', '=', 'users.id')
                    ->select('*')
                    ->get();
        $posts = Post::paginate(3);

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
            'data_jumlah_mitras' => $data_jumlah_mitras,
            'data_jumlah_users' => $data_jumlah_users,
            'data_jumlah_customers' => $data_jumlah_customers,
            'reviews' => $reviews,
            'posts' => $posts,
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
        $images_rooms = DB::table('images')
        ->join('room_images', 'room_images.image_id', '=', 'images.id')
        ->select('images.image')
        ->get();
        $tombols = Tombol::all();
        return view('compro.front.mitra', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
            'sliderMitras' => $kontaks,
            'prosesPendaftarans' => $prosesPendaftarans,
            'syarats' => $syarats,
            'images_rooms' => $images_rooms,
            'tombols' => $tombols,
        ], compact('unduhs'));
    }

    public function hotel() {
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        $images_one = DB::table('reviews')
                    ->join('rooms', 'rooms.id', '=', 'reviews.reviewable_id')
                    ->leftjoin('room_images', 'room_images.room_id', '=', 'rooms.id')
                    ->leftjoin('accomodations', 'accomodations.id', '=', 'rooms.accomodation_id')
                    ->leftjoin('images', 'images.id', '=', 'room_images.image_id')
                    ->join('types', 'types.id', '=', 'rooms.type_id')
                    ->select('accomodations.name', 'reviews.rating', 'images.image')
                    ->first();
        $hotels = DB::table('reviews')
                    ->join('rooms', 'rooms.id', '=', 'reviews.reviewable_id')
                    ->leftjoin('room_images', 'room_images.room_id', '=', 'rooms.id')
                    ->leftjoin('accomodations', 'accomodations.id', '=', 'rooms.accomodation_id')
                    ->leftjoin('images', 'images.id', '=', 'room_images.image_id')
                    ->join('types', 'types.id', '=', 'rooms.type_id')
                    ->select('accomodations.name as nama_hotel', 'reviews.rating', 'images.image', 'types.name', 'rooms.id')
                    // ->where('rooms.status', '=', 'available')
                    ->get();
        $types = DB::table('reviews')
                    ->join('rooms', 'rooms.id', '=', 'reviews.reviewable_id')
                    ->leftjoin('room_images', 'room_images.room_id', '=', 'rooms.id')
                    ->leftjoin('accomodations', 'accomodations.id', '=', 'rooms.accomodation_id')
                    ->leftjoin('images', 'images.id', '=', 'room_images.image_id')
                    ->join('types', 'types.id', '=', 'rooms.type_id')
                    ->select('types.name')
                    ->groupBy('types.name')
                    ->get();
            return view('compro.front.hotel', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
            'images' => $images_one,
            'hotels' => $hotels,
            'types' => $types,
        ]);
    }

    public function cariHotelKategori(Request $request) {

        $cari = $request->get('cari');
        $hotels = DB::table('reviews')
                    ->join('rooms', 'rooms.id', '=', 'reviews.reviewable_id')
                    ->leftjoin('room_images', 'room_images.room_id', '=', 'rooms.id')
                    ->leftjoin('accomodations', 'accomodations.id', '=', 'rooms.accomodation_id')
                    ->leftjoin('images', 'images.id', '=', 'room_images.image_id')
                    ->join('types', 'types.id', '=', 'rooms.type_id')
                    ->select('accomodations.name as nama_hotel', 'reviews.rating', 'images.image', 'types.name', 'rooms.id')
                    // ->where('rooms.status', '=', 'available')
                    ->where('types.name', '=', "$cari")
                    ->get();
        $data = [
            'data' => 'ada',
            'hotels' => $hotels,
        ];

        return response()->json($data);
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

    public function cariBantuan(Request $request) {
        $cari = $request->get('cari');
        if($cari == null) {
            $pertanyaans = Pertanyaan::all();
            $data = [
                'data' => "kosong",
                'pertanyaans' => $pertanyaans,
            ];

        }else{
            $pertanyaans = Pertanyaan::where('keterangan','LIKE','%'. $cari .'%')->get();
            $data = [
                'data' => "tidak kosong",
                'pertanyaans' => $pertanyaans,
            ];
        }
        return response()->json($data);
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

    public function data_mitra() {
        $data_mitras = Accomodation::count();

        return response()->json($data_mitras);
    }

    public function readPertanyaan($id) {
        $pertanyaans = Pertanyaan::find($id);
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        return view('compro.front.read_pertanyaan', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
            'pertanyaans' => $pertanyaans,
        ]);
    }

    public function readBerita($id) {
        $posts = Post::find($id);
        $alamats = Alamat::all();
        $sosmeds = Sosmed::all();
        $kontaks = Kontak::all();
        $lains = Post::paginate(3);
        return view('compro.front.read_berita', [
            'alamats' => $alamats,
            'sosmeds' => $sosmeds,
            'kontaks' => $kontaks,
            'posts' => $posts,
            'lains' => $lains,
        ]);
    }

    public function cariAvailable(Request $request, Room $room) {
        $kapan = $request->get('kapan');


        $rooms_available = $hotels = DB::table('reviews')
                        ->join('rooms', 'rooms.id', '=', 'reviews.reviewable_id')
                        ->leftjoin('room_images', 'room_images.room_id', '=', 'rooms.id')
                        ->leftjoin('accomodations', 'accomodations.id', '=', 'rooms.accomodation_id')
                        ->leftjoin('images', 'images.id', '=', 'room_images.image_id')
                        ->join('types', 'types.id', '=', 'rooms.type_id')
                        ->select('accomodations.name as nama_hotel', 'reviews.rating', 'images.image', 'types.name', 'rooms.id')
                        // ->where('rooms.status', '=', 'available')
                        ->get();

        $data = [
            'data' => 'ada',
            'room_availables' => $rooms_available,
        ];



        return response()->json($data);
    }

}
