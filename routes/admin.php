<?php

use App\Http\Controllers\Admin\AccomodationController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\OfficeListController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PrivacyPoliciesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RefferalController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VoucherController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);

Route::resource('users', UsersController::class)->except(['index', 'store', 'create']);
Route::get('users', [UsersController::class, 'showEmployee'])->name('users.employee');
Route::get('customers', [UsersController::class, 'showCustomer'])->name('users.customer');
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
Route::resource('privacy', PrivacyPoliciesController::class);

Route::name('admin.')->group(function() {

    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('', [DashboardController::class, 'index'])->name('index');
    });

    Route::prefix('post')->name('post.')->group(function() {
        Route::get('', [PostController::class, 'index'])->name('index');
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('', [PostController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::get('{id}/show', [PostController::class, 'show'])->name('show');
        Route::put('', [PostController::class, 'update'])->name('update');
        Route::delete('', [PostController::class, 'delete'])->name('delete');
    });

    Route::prefix('point')->name('point.')->group(function() {
        Route::get('', [PointController::class, 'index'])->name('index');
        Route::get('{id}/show', [PointController::class, 'show'])->name('show');
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
    Route::prefix('category-post')->name('category_post.')->group(function() {
        Route::get('', [CategoryPostController::class, 'index'])->name('index');
        Route::get('create', [CategoryPostController::class, 'create'])->name('create');
        Route::post('', [CategoryPostController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CategoryPostController::class, 'edit'])->name('edit');
        Route::put('', [CategoryPostController::class, 'update'])->name('update');
        Route::delete('', [CategoryPostController::class, 'delete'])->name('delete');
    });

    Route::prefix('product')->name('product.')->group(function() {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('', [ProductController::class, 'store'])->name('store');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('', [ProductController::class, 'update'])->name('update');
        Route::delete('', [ProductController::class, 'delete'])->name('delete');
    });
    
    Route::prefix('voucher')->name('voucher.')->group(function() {
        Route::get('', [VoucherController::class, 'index'])->name('index');
        Route::get('create', [VoucherController::class, 'create'])->name('create');
        Route::post('', [VoucherController::class, 'store'])->name('store');
        Route::get('{id}/edit', [VoucherController::class, 'edit'])->name('edit');
        Route::get('{id}/show', [VoucherController::class, 'show'])->name('show');
        Route::put('', [VoucherController::class, 'update'])->name('update');
        Route::delete('', [VoucherController::class, 'delete'])->name('delete');
    });

    Route::resource('promotion', PromotionController::class);
    Route::get('refferals', [RefferalController::class, 'index'])->name('refferals.index');

    Route::get('refunds', [RefundController::class, 'index'])->name('refund.index');
    Route::get('refunds/detail/{refund}', [RefundController::class, 'show'])->name('refund.show');
    Route::get('refunds/action/{refund}', [RefundController::class, 'actionPage'])->name('refund.action.page');
    Route::post('refunds/action/{refund}', [RefundController::class, 'action'])->name('refund.action');

    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('order/detail/{order}', [OrderController::class, 'detail'])->name('order.detail');
    Route::post('order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

    require __DIR__.'/setting.php';


});

