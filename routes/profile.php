<?php  

use App\Http\Controllers\Profile\HomeController;
use App\Http\Controllers\Profile\RegisterController;
use App\Http\Resources\FilterResource;
use App\Models\Accomodation;
use App\Models\Facility;
use App\Models\Province;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

Route::get('test', function(){
	// $location = Province::select('id', 'name')->has('accomodation')->get();

	// $room = Type::select('id', 'name')->has('rooms')->get();

	// $facilities = Facility::select('id', 'name')->has('room')->get();

	// return FilterResource::collection([
	// 	'location' => $location, 
	// 	'room_type' => $room,
	// 	'ratings' => [
	// 		['id' => 1, 'name' => 1],
	// 		['id' => 2, 'name' => 2],
	// 		['id' => 3, 'name' => 3],
	// 		['id' => 4, 'name' => 4],
	// 		['id' => 5, 'name' => 5],
	// 	],
	// 	'facilities' => $facilities,
	// ]);

	$accomodation = Accomodation::with([
		'image',
		'room',
		'room.type' => function($query) {
			$query->where('name', "medium");
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
	return response()->json($accomodation);
});
Route::name('profile.')->group(function(){

	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('/mitra', [HomeController::class, 'mitra'])->name('mitra');
	Route::get('/hotel', [HomeController::class, 'hotel'])->name('hotel');
	Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
	Route::get('/bantuan', [HomeController::class, 'bantuan'])->name('bantuan');
	Route::get('/informasi/{slug}', [HomeController::class, 'detailInformasi'])->name('informasi.detail');

	Route::get('/register', [RegisterController::class, 'showregister'])->name('register');
	Route::post('/register/submit', [RegisterController::class, 'submitRegister'])->name('register.submit');

	Route::post('/accomodation/top', [HomeController::class, 'accomodationTop'])->name('accomodation.top');
	Route::post('/room/check', [HomeController::class, 'roomCheck'])->name('room.check');

	Route::post('/bantuan/pertanyaan/search', [HomeController::class, 'pertanyaanSearch'])->name('bantuan.pertanyaan.search');
	Route::get('/bantuan/pertanyaan/{id}', [HomeController::class, 'pertanyaanDetail'])->name('bantuan.pertanyaan.detail');;
});

