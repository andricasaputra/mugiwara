<?php  

use App\Http\Controllers\Profile\HomeController;
use App\Http\Controllers\Profile\RegisterController;
use Illuminate\Support\Facades\Route;

Route::name('profile.')->group(function(){

	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('/mitra', [HomeController::class, 'mitra'])->name('mitra');
	Route::get('/hotel', [HomeController::class, 'hotel'])->name('hotel');
	Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
	Route::get('/bantuan', [HomeController::class, 'bantuan'])->name('bantuan');
	Route::get('/informasi/{id}', [HomeController::class, 'detailInformasi'])->name('informasi.detail');

	Route::get('/register', [RegisterController::class, 'showregister'])->name('register');
	Route::post('/register/submit', [RegisterController::class, 'submitRegister'])->name('register.submit');

	Route::get('/accomodation/top', [HomeController::class, 'accomodationTop'])->name('accomodation.top');
	Route::post('/room/check', [HomeController::class, 'roomCheck'])->name('room.check');

	Route::get('/bantuan/pertanyaan/{id}', [HomeController::class, 'pertanyaanDetail'])->name('bantuan.pertanyaan.detail');;
});

