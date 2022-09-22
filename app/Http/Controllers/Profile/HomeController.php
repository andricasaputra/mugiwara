<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Pipelines\QueryFilters\Take;
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
use App\Models\Post;
use App\Models\SliderFitur;
use App\Models\SliderMitra;
use App\Models\SyaratDokumen;
use App\Models\Tambah_menu_compro;
use App\Models\TambahBerandaInformasi;
use App\Models\TambahSlider;
use App\Models\TambahSliderTentang;
use App\Models\TeamHeader;
use App\Models\Tentang;
use App\Models\Type;
use App\Models\VisiMisi;
use App\Repositories\AccomodationRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function __construct(protected AccomodationRepository $repository)
    {
    }

    public function index()
    {
        $sliders = TambahSlider::all();
        $beranda = Beranda::all();
        $settingPlayStore = PlayStoreLink::orderBy('created_at', 'desc')->first();
        $settingAppStore = AppStoreLink::orderBy('created_at', 'desc')->first();
        $fitur = SliderFitur::all();
        $sliderTentang = TambahSliderTentang::limit(6)->get();
        $informasi = Post::where('is_active', 1)->get();
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
        $menu = Tambah_menu_compro::where('status', 1)->get();
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
        $menu = Tambah_menu_compro::where('status', 1)->get();
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
            $accomodationTop = Accomodation::with([
                'room',
                'room.images'
            ])
            ->withAvg('reviews', 'rating')
            ->where('id', $accomodationTopRate->accomodation_id)->first();
            if (!empty($accomodationTop->room)) {
                foreach ($accomodationTop->room as $k => $r) {
                    if(!empty($r->images)) {
                        foreach($r->images as $rk => $ri) {
                            $accomodationTopImage = $ri->image;
                            break;
                        } 
                    }
                }
            }
        }
        $settings = GeneralSettings::first();
        $settingPlayStore = PlayStoreLink::orderBy('created_at', 'desc')->first();
        $settingAppStore = AppStoreLink::orderBy('created_at', 'desc')->first();
        return view('profile.hotel', [
            'title' => 'Hotel',
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'kategori' => $kategori,
            'accomodationTop' => $accomodationTop,
            'accomodationTopRate' => $accomodationTopRate,
            'accomodationTopImage' => $accomodationTopImage,
            'settingPlayStore' => $settingPlayStore,
            'settingAppStore' => $settingAppStore,
        ]);
    }

    public function tentang()
    {
        $menu = Tambah_menu_compro::where('status', 1)->get();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $visiMisi = VisiMisi::all();
        $team = TeamHeader::all();
        $settings = GeneralSettings::first();
        $tentang = Tentang::all();
        return view('profile.team', [
            'title' => 'Tentang Kami',
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'visiMisi' => $visiMisi,
            'team' => $team,
            'tentang' => $tentang
        ]);
    }

    public function bantuan()
    {
        $menu = Tambah_menu_compro::where('status', 1)->get();
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

    public function detailInformasi($slug)
    {
        $menu = Tambah_menu_compro::where('status', 1)->get();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $informasi = Post::where('slug', $slug)->first();
        $informasiAll = Post::where('slug', '!=', $slug)->where('is_active', 1)->get();
        $settings = GeneralSettings::first();
        return view('profile.detail_informasi', [
            'title' => 'Beranda - Informasi',
            'settings' => $settings,
            'menu' => $menu,
            'informasi' => $informasi,
            'informasiAll' => $informasiAll,
            'alamat' => $alamat,
        ]);
    }

    public function roomCheck()
    {
        $accomodations = Accomodation::with([
        	'image',
        	'room' => function($query){
        		if(request()->category == 'rekomendasi'){
					 $accomodations =  $query->whereNotNull('discount_type');
				}

				

				if(request()->status){
			
					 $accomodations = $query->where('status', request()->status);
				}

				if(request()->rating){
					 $accomodations =  $query
					 ->having('reviews_avg_rating', '>=', request()->rating)
					 ->having('reviews_avg_rating', '<', request()->rating + 1);
				}

				$query->withCount('reviews')->withAvg('reviews', 'rating');
        	},
			'room.images', 
			'province', 
			'regency',
			'room.type' => function($query) {
				if(request()->type) {
                    $query->where('name', request()->type);
                }
			},
			'room.facilities' => function($query) {
				
				if(request()->facilities) {

					if(str_contains(request()->facilities, ',')){
						$facilities = explode(",", request()->facilities);

						$query->whereIn('name', $facilities);
					} else {
						$query->where('name', request()->facilities);
					}
				}
			},
		])
		->withAvg('reviews', 'rating')
		->withCount([
			'room',
			'room as available_room_count' => function (Builder $query) {
			    $query->where('status', 'available');
			},
			'room as booked_room_count' => function (Builder $query) {
			    $query->where('status', 'booked');
			},
			'room as stayed_room_count' => function (Builder $query) {
			    $query->where('status', 'stayed');
			}

		]);
		
		if(request()->rating){
			 $accomodations =  $accomodations
			 ->having('reviews_avg_rating', '>=', request()->rating)
			 ->having('reviews_avg_rating', '<', request()->rating + 1);
		}

		if(request()->category == 'populer'){

			// $count = Order::where('order_status', 'completed')->groupBy('accomodation_id')->get()->count();

			$accomodations =  $accomodations->whereHas('orders',function($q) {
				$q->where('order_status', 'completed');
			});
		}

		if(request()->category == 'trending'){
			
			 $accomodations =  $accomodations->having('reviews_avg_rating', '>=', '4.0');
		}

        $res = app(Pipeline::class)
            ->send($accomodations)
            ->through([
            	 \App\Http\Pipelines\QueryFilters\Sort::class,
                \App\Http\Pipelines\QueryFilters\Relations\Search::class,
                \App\Http\Pipelines\QueryFilters\Relations\Status::class,
                \App\Http\Pipelines\QueryFilters\Relations\Category::class,
                \App\Http\Pipelines\QueryFilters\Relations\Location::class
            ])
            ->thenReturn()
            ->paginate(Take::getDefaultPerPage())
            ->appends(request()->input());
        return response()->json($res);
    }

    public function accomodationTop(Request $request)
    {
        $accomodation = Accomodation::with([
            'image',
            'room',
            'room.images',
            'room.type' => function($query) use ($request) {
                $query->where('name', $request->type);
            },
        ])
        ->withAvg('reviews', 'rating')
        ->withCount([
            'room',
            'room as available_room_count' => function (Builder $query) {
                $query->where('status', 'available');
            },
            'room as booked_room_count' => function (Builder $query) {
                $query->where('status', 'booked');
            },
            'room as stayed_room_count' => function (Builder $query) {
                $query->where('status', 'stayed');
            }

        ])->limit(4)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil get data',
            'data' => $accomodation
        ]);
    }

    public function pertanyaanDetail($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $menu = Tambah_menu_compro::where('status', 1)->get();
        $alamat = Alamat::orderBy('created_at', 'desc')->first();
        $settings = GeneralSettings::first();
        $lainnya = Pertanyaan::where('kategori', 'lain-lain')->limit(7)->get();
        return view('profile.detail_pertanyaan', [
            'title' => 'Pertanyaan',
            'settings' => $settings,
            'menu' => $menu,
            'alamat' => $alamat,
            'pertanyaan' => $pertanyaan,
            'lainnya' => $lainnya
        ]);
    }

    public function pertanyaanSearch(Request $request)
    {
        $pertanyaan = Pertanyaan::where('keterangan', 'like', '%'. $request->param .'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data',
            'data' => $pertanyaan
        ]);
    }
}
