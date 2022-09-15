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
use App\Http\Controllers\Employee\RefundController;
use App\Http\Controllers\Employee\UsersController;
use App\Http\Controllers\Employee\VoucherController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MitraGabungController;
use App\Http\Controllers\PenukaranMarchendiseController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return redirect(route('login'));
// });


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
        Route::get('orders/checkin/{order}', [OrderController::class, 'checkinPage'])->name('order.checkin.page');
        Route::post('orders/checkin', [OrderController::class, 'checkin'])->name('order.checkin');

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

            Route::get('tukar_marchendise', [PenukaranMarchendiseController::class, 'index'])->name('tukar_marchendise');
            Route::get('tambah_penukaran', [PenukaranMarchendiseController::class, 'create'])->name('tambah_penukaran');
            Route::post('store_penukaran', [PenukaranMarchendiseController::class, 'store'])->name('store_penukaran');
            Route::get('hapus_penukaran/{id}', [PenukaranMarchendiseController::class, 'destroy'])->name('hapus_penukaran');
            Route::get('update_penukaran/{id}', [PenukaranMarchendiseController::class, 'update'])->name('update_penukaran');
            Route::get('edit_penukaran/{id}', [PenukaranMarchendiseController::class, 'edit'])->name('edit_penukaran');
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

        Route::get('refunds', [RefundController::class, 'index'])->name('refund.index');
        Route::get('refunds/detail/{refund}', [RefundController::class, 'show'])->name('refund.show');
        Route::get('refunds/action/{refund}', [RefundController::class, 'actionPage'])->name('refund.action.page');
        Route::post('refunds/action/{refund}', [RefundController::class, 'action'])->name('refund.action');
        });


});

Route::get('/', [FrontController::class, 'index'])->name('front');
Route::get('jadi_mitra/', [FrontController::class, 'jadi_mitra'])->name('jadi.mitra');
Route::get('hotel/', [FrontController::class, 'hotel'])->name('hotel');
Route::get('tentang_kami/', [FrontController::class, 'tentang'])->name('tentang');
Route::get('bantuan/', [FrontController::class, 'bantuan'])->name('bantuan');
Route::get('gabung/', [FrontController::class, 'gabung'])->name('gabung');
Route::get('read_pertanyaan/{id}', [FrontController::class, 'readPertanyaan'])->name('readPertanyaan');
Route::get('read_berita/{id}', [FrontController::class, 'readBerita'])->name('readBerita');
Route::post('store', [MitraGabungController::class, 'store'])->name('store.mitraGabung');


Route::post('cari_bantuan/', [FrontController::class, 'cariBantuan'])->name('cariBantuan');
Route::post('cari_hotel_kategori/', [FrontController::class, 'cariHotelKategori'])->name('cariHotelKategori');
Route::post('cariAvailable/', [FrontController::class, 'cariAvailable'])->name('cariAvailable');

Route::get('data_mitra_bergabung/', [FrontController::class, 'data_mitra'])->name('data.mitra');


// Route::prefix('hubungiKami')->name('hubungiKami.')->group(function() {
    // Route::get('', [HubungiKamiController::class, 'index'])->name('hubungiKami');
    // Route::get('create', [HubungiKamiController::class, 'create'])->name('create.hubungiKami');
    // Route::get('edit/{id}', [HubungiKamiController::class, 'edit'])->name('edit.hubungiKami');
    Route::post('hub', [HubungiKamiController::class, 'store'])->name('store.hubungi');
    // Route::post('update/{id}', [HubungiKamiController::class, 'update'])->name('update.hubungiKami');
    // Route::get  ('delete/{id}', [HubungiKamiController::class, 'destroy'])->name('delete.hubungiKami');

    // });

require __DIR__.'/auth.php';


