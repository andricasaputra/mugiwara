<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HotelCategoryController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\HotelOfficeController;
use App\Http\Controllers\Admin\HotelSubOfficeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TypeController;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::name('admin.')->group(function() {
    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('', [DashboardController::class, 'index'])->name('index');
    });
    Route::prefix('post')->name('post.')->group(function() {
        Route::get('', [PostController::class, 'index'])->name('index');
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('', [PostController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('', [PostController::class, 'update'])->name('update');
        Route::delete('', [PostController::class, 'delete'])->name('delete');
    });
    Route::prefix('slider')->name('slider.')->group(function() {
        Route::get('', [SliderController::class, 'index'])->name('index');
        Route::get('create', [SliderController::class, 'create'])->name('create');
        Route::post('', [SliderController::class, 'store'])->name('store');
        Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('', [SliderController::class, 'update'])->name('update');
        Route::delete('', [SliderController::class, 'delete'])->name('delete');
    });
    
    Route::prefix('hotel')->name('hotel.')->group(function() {
        Route::get('', [HotelController::class, 'index'])->name('index');
        Route::get('create', [HotelController::class, 'create'])->name('create');
        Route::post('', [HotelController::class, 'store'])->name('store');
        Route::get('{id}/edit', [HotelController::class, 'edit'])->name('edit');
        Route::put('', [HotelController::class, 'update'])->name('update');
        Route::delete('', [HotelController::class, 'delete'])->name('delete');
    });
    Route::prefix('hotel-category')->name('hotel_category.')->group(function() {
        Route::get('{idHotel}', [HotelCategoryController::class, 'index'])->name('index');
        Route::get('{idHotel}/create', [HotelCategoryController::class, 'create'])->name('create');
        Route::post('', [HotelCategoryController::class, 'store'])->name('store');
        Route::get('{id}/{idHotel}/edit', [HotelCategoryController::class, 'edit'])->name('edit');
        Route::put('', [HotelCategoryController::class, 'update'])->name('update');
        Route::delete('', [HotelCategoryController::class, 'delete'])->name('delete');
    });
    Route::prefix('hotel-office')->name('hotel_office.')->group(function() {
        Route::get('{idHotel}', [HotelOfficeController::class, 'index'])->name('index');
        Route::get('{idHotel}/create', [HotelOfficeController::class, 'create'])->name('create');
        Route::post('', [HotelOfficeController::class, 'store'])->name('store');
        Route::get('{id}/{idHotel}/edit', [HotelOfficeController::class, 'edit'])->name('edit');
        Route::put('', [HotelOfficeController::class, 'update'])->name('update');
        Route::delete('', [HotelOfficeController::class, 'delete'])->name('delete');
    });
    Route::prefix('hotel-sub_office')->name('hotel_sub_office.')->group(function() {
        Route::get('{idHotel}', [HotelSubOfficeController::class, 'index'])->name('index');
        Route::get('{idHotel}/create', [HotelSubOfficeController::class, 'create'])->name('create');
        Route::post('', [HotelSubOfficeController::class, 'store'])->name('store');
        Route::get('{id}/{idHotel}/edit', [HotelSubOfficeController::class, 'edit'])->name('edit');
        Route::put('', [HotelSubOfficeController::class, 'update'])->name('update');
        Route::delete('', [HotelSubOfficeController::class, 'delete'])->name('delete');
    });
    Route::prefix('type')->name('type.')->group(function() {
        Route::get('', [TypeController::class, 'index'])->name('index');
        Route::get('create', [TypeController::class, 'create'])->name('create');
        Route::post('', [TypeController::class, 'store'])->name('store');
        Route::get('{id}/edit', [TypeController::class, 'edit'])->name('edit');
        Route::put('', [TypeController::class, 'update'])->name('update');
        Route::delete('', [TypeController::class, 'delete'])->name('delete');
    });
    Route::prefix('room')->name('room.')->group(function() {
        Route::get('', [RoomController::class, 'index'])->name('index');
        Route::get('create', [RoomController::class, 'create'])->name('create');
        Route::post('', [RoomController::class, 'store'])->name('store');
        Route::get('{id}/edit', [RoomController::class, 'edit'])->name('edit');
        Route::put('', [RoomController::class, 'update'])->name('update');
        Route::delete('', [RoomController::class, 'delete'])->name('delete');
    });
});