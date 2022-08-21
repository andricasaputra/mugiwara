<?php

use App\Http\Controllers\Api\Auth\GoogleApiController;
use App\Http\Controllers\Employee\AccomodationController;
use App\Http\Controllers\Employee\BookingController;
use App\Http\Controllers\Employee\CategoryPostController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\FacilityController;
use App\Http\Controllers\Employee\FinanceController;
use App\Http\Controllers\Employee\NotificationController;
use App\Http\Controllers\Employee\OfficeListController;
use App\Http\Controllers\Employee\OrderController;
use App\Http\Controllers\Employee\PostController;
use App\Http\Controllers\Employee\PrivacyPoliciesController;
use App\Http\Controllers\Employee\ProductController;
use App\Http\Controllers\Employee\RefferalController;
use App\Http\Controllers\Employee\RoomController;
use App\Http\Controllers\Employee\RoomTypeController;
use App\Http\Controllers\Employee\UsersController;
use App\Http\Controllers\Employee\VoucherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Route::middleware('verified')->group(function(){

    Route::get('users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit.employee');

    Route::put('users/update/{user}', [UsersController::class, 'update'])->name('users.update.employee');

    Route::resource('offices', OfficeListController::class);
    Route::get('accomodations_room/add/{accomodation}', [AccomodationController::class, 'add'])->name('accomodations.add');

    Route::post('accomodations_room/add/', [AccomodationController::class, 'storeRoom'])->name('accomodations.store_room');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('employee.')->group(function() {

        Route::prefix('dashboard')->group(function() {
            
            Route::post('orderchart', [DashboardController::class, 'orderChart'])->name('dashboard.orderchart');
            Route::post('pointchart', [DashboardController::class, 'pointChart'])->name('dashboard.pointchart');
            Route::post('financechart', [DashboardController::class, 'financeChart'])->name('dashboard.financechart');
        });

        Route::resource('booking', BookingController::class);
        Route::resource('privacy', PrivacyPoliciesController::class);

        Route::get('order', [OrderController::class, 'index'])->name('order.index');
        Route::get('order/detail/{order}', [OrderController::class, 'detail'])->name('order.detail');
        Route::post('order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

        Route::get('finance', [FinanceController::class, 'index'])->name('finance.index');

        Route::get('finance/detail/{payment}', [FinanceController::class, 'paymentDetail'])->name('finance.detail');

        Route::get('finance/balace', [FinanceController::class, 'getBalance'])->name('finance.balance');

        Route::get('finance/transaction/list/{page?}/{limit?}/{link?}', [FinanceController::class, 'transaction'])->name('finance.transaction.list');


        Route::get('finance/transaction/detail/{id}', [FinanceController::class, 'transactionDetail'])->name('finance.transaction.detail');

        Route::get('finance/invoices', [FinanceController::class, 'allInvoices'])->name('finance.invoices');

        Route::prefix('post')->name('post.')->group(function() {
            Route::get('', [PostController::class, 'index'])->name('index');
            Route::get('create', [PostController::class, 'create'])->name('create');
            Route::post('', [PostController::class, 'store'])->name('store');
            Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
            Route::get('{id}/show', [PostController::class, 'show'])->name('show');
            Route::put('', [PostController::class, 'update'])->name('update');
            Route::delete('', [PostController::class, 'delete'])->name('delete');
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

         Route::get('refferals', [RefferalController::class, 'index'])->name('refferals.index');

         Route::get('notifications/{id}', [NotificationController::class, 'markAsRead'])->name('notification.markasread');
    });
});




require __DIR__.'/auth.php';


