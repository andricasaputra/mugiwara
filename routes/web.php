<?php

use App\Http\Controllers\Admin\PrivacyPoliciesController;
use App\Http\Controllers\Employee\CategoryPostController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\FinanceController;
use App\Http\Controllers\Employee\NotificationController;
use App\Http\Controllers\Employee\OfficeListController;
use App\Http\Controllers\Employee\OrderController;
use App\Http\Controllers\Employee\PaymentController;
use App\Http\Controllers\Employee\PointController;
use App\Http\Controllers\Employee\PostController;
use App\Http\Controllers\Employee\ProductController;
use App\Http\Controllers\Employee\RefferalController;
use App\Http\Controllers\Employee\UsersController;
use App\Http\Controllers\Employee\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('privacy/{privacy}', [PrivacyPoliciesController::class, 'show'])->name('privacy.show');

Route::middleware(['verified', 'panel'])->group(function(){

    Route::get('users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit.employee');

    Route::put('users/update/{user}', [UsersController::class, 'update'])->name('users.update.employee');

    Route::resource('offices', OfficeListController::class);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('employee.')->group(function() {

        Route::prefix('dashboard')->group(function() {
            
            Route::post('orderchart', [DashboardController::class, 'orderChart'])->name('dashboard.orderchart');
            Route::post('pointchart', [DashboardController::class, 'pointChart'])->name('dashboard.pointchart');
            Route::post('financechart', [DashboardController::class, 'financeChart'])->name('dashboard.financechart');
        });

        Route::get('orders', [OrderController::class, 'index'])->name('order.index');
        Route::get('orders/detail/{order}', [OrderController::class, 'detail'])->name('order.detail');
        Route::post('orders/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

        Route::get('finance', [FinanceController::class, 'index'])->name('finance.index');

        Route::get('finance/detail/{payment}', [FinanceController::class, 'paymentDetail'])->name('finance.detail');

        Route::get('finance/balace', [FinanceController::class, 'getBalance'])->name('finance.balance');

        Route::get('finance/transaction/list/{page?}/{limit?}/{link?}', [FinanceController::class, 'transaction'])->name('finance.transaction.list');


        Route::get('finance/transaction/detail/{id}', [FinanceController::class, 'transactionDetail'])->name('finance.transaction.detail');

        Route::get('finance/invoices/{payment}', [FinanceController::class, 'invoices'])->name('finance.invoices');

        Route::post('payment/export/excel', [PaymentController::class, 'export'])->name('payment.export.excel');

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
            Route::get('redeem/lists', [ProductController::class, 'redeemList'])->name('redeem.list');
        });

         Route::prefix('voucher')->name('voucher.')->group(function() {
            Route::get('', [VoucherController::class, 'index'])->name('index');
            Route::get('{id}/show', [VoucherController::class, 'show'])->name('show');
            Route::get('redeem/lists', [VoucherController::class, 'redeemList'])->name('redeem.list');
        });

         Route::get('refferals', [RefferalController::class, 'index'])->name('refferals.index');

         Route::get('notifications/{id}', [NotificationController::class, 'markAsRead'])->name('notification.markasread');
         Route::get('notifications/readall/mark', [NotificationController::class, 'markAsReadAll'])->name('notification.markasread.all');
          Route::delete('notifications/delete/all', [NotificationController::class, 'destroyAll'])->name('notification.destroy.all');
          Route::prefix('point')->name('point.')->group(function() {
            Route::get('', [PointController::class, 'index'])->name('index');
            Route::get('{id}/show', [PointController::class, 'show'])->name('show');
        });

        Route::get('notifications', [NotificationController::class, 'index'])->name('notification.index');
        Route::delete('notifications/delete', [NotificationController::class, 'destroy'])->name('notification.destroy');
        Route::get('notifications/{id}', [NotificationController::class, 'markAsRead'])->name('notification.markasread');
    });
});

require __DIR__.'/auth.php';


