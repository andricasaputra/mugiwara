<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SliderController;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::prefix('admin')->name('admin.')->group(function() {
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
});