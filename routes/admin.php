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

use App\Http\Controllers\Admin\AccomodationController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\OfficeListController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\UsersController;


Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);

Route::resource('users', UsersController::class)->except(['store', 'create']);
Route::get('users/roles/{user}', [UsersController::class, 'roles'])->name('users.roles');
Route::post('users/roles/{user}', [UsersController::class, 'attachRoles'])->name('users.attach.roles');

Route::get('users/permissions/{user}', [UsersController::class, 'permissions'])->name('users.permissions');
Route::post('users/permissions/{user}', [UsersController::class, 'attachPermissions'])->name('users.attach.permissions');

Route::resource('offices', OfficeListController::class);
Route::get('accomodations_room/add/{accomodation}', [AccomodationController::class, 'add'])->name('accomodations.add');
Route::post('accomodations_room/add/', [AccomodationController::class, 'storeRoom'])->name('accomodations.store_room');
Route::resource('accomodations', AccomodationController::class);

Route::resource('rooms', RoomController::class);
Route::resource('facilities', FacilityController::class);
Route::resource('room_types', RoomTypeController::class);
Route::resource('booking', BookingController::class);


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
    

    Route::prefix('type')->name('type.')->group(function() {
        Route::get('', [TypeController::class, 'index'])->name('index');
        Route::get('create', [TypeController::class, 'create'])->name('create');
        Route::post('', [TypeController::class, 'store'])->name('store');
        Route::get('{id}/edit', [TypeController::class, 'edit'])->name('edit');
        Route::put('', [TypeController::class, 'update'])->name('update');
        Route::delete('', [TypeController::class, 'delete'])->name('delete');
    });
    // Route::prefix('room')->name('room.')->group(function() {
    //     Route::get('', [RoomController::class, 'index'])->name('index');
    //     Route::get('create', [RoomController::class, 'create'])->name('create');
    //     Route::post('', [RoomController::class, 'store'])->name('store');
    //     Route::get('{id}/edit', [RoomController::class, 'edit'])->name('edit');
    //     Route::put('', [RoomController::class, 'update'])->name('update');
    //     Route::delete('', [RoomController::class, 'delete'])->name('delete');
    // });
});

