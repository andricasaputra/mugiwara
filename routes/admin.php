<?php  

use App\Http\Controllers\Admin\AccomodationController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\OfficeListController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\UsersController;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);

Route::resource('users', UsersController::class)->except(['store', 'create']);
Route::get('users/roles/{user}', [UsersController::class, 'roles'])->name('users.roles');
Route::post('users/roles/{user}', [UsersController::class, 'attachRoles'])->name('users.attach.roles');

Route::get('users/permissions/{user}', [UsersController::class, 'permissions'])->name('users.permissions');
Route::post('users/permissions/{user}', [UsersController::class, 'attachPermissions'])->name('users.attach.permissions');

Route::resource('offices', OfficeListController::class);
Route::resource('accomodations', AccomodationController::class);
Route::resource('rooms', RoomController::class);
Route::resource('facilities', FacilityController::class);
Route::resource('room_types', RoomTypeController::class);
Route::resource('booking', BookingController::class);
