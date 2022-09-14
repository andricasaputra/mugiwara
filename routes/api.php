<?php

use App\Http\Controllers\Admin\RegencyController;
use App\Http\Controllers\Api\AccomdationController;
use App\Http\Controllers\Api\AccountUserController;
use App\Http\Controllers\Api\Auth\GoogleApiController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResendVerifyOtpController;
use App\Http\Controllers\Api\Auth\UpdatePasswordController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Auth\VerifyMobileController;
use App\Http\Controllers\Api\CategoryPostController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OfficeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\PoinController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PrivacyController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\RefferralController;
use App\Http\Controllers\Api\RefundController;
use App\Http\Controllers\Api\ReviewsController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\UserPointController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\XenditCallbackController;
use App\Http\Controllers\Api\PlayStoreController;
use App\Http\Controllers\Api\AppStoreController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HubungiKamiController;
use App\Http\Controllers\MitraGabungController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('front/', [FrontController::class, 'index'])->name('front');
Route::get('jadi_mitra/', [FrontController::class, 'jadi_mitra'])->name('jadi.mitra');
Route::get('hotel/', [FrontController::class, 'hotel'])->name('hotel');
Route::get('tentang_kami/', [FrontController::class, 'tentang'])->name('tentang');
Route::get('bantuan/', [FrontController::class, 'bantuan'])->name('bantuan');
Route::get('gabung/', [FrontController::class, 'gabung'])->name('gabung');
Route::get('read_pertanyaan/{id}', [FrontController::class, 'readPertanyaan'])->name('readPertanyaan');
Route::post('store', [MitraGabungController::class, 'store'])->name('store.mitraGabung');


Route::post('cari_bantuan/', [FrontController::class, 'cariBantuan'])->name('cariBantuan');

Route::get('data_mitra_bergabung/', [FrontController::class, 'data_mitra'])->name('data.mitra');


// Route::prefix('hubungiKami')->name('hubungiKami.')->group(function() {
    // Route::get('', [HubungiKamiController::class, 'index'])->name('hubungiKami');
    // Route::get('create', [HubungiKamiController::class, 'create'])->name('create.hubungiKami');
    // Route::get('edit/{id}', [HubungiKamiController::class, 'edit'])->name('edit.hubungiKami');
    Route::post('hub', [HubungiKamiController::class, 'store'])->name('store.hubungi');
    // Route::post('update/{id}', [HubungiKamiController::class, 'update'])->name('update.hubungiKami');
    // Route::get  ('delete/{id}', [HubungiKamiController::class, 'destroy'])->name('delete.hubungiKami');

    // });

Route::post('auth/google/', [GoogleApiController::class, 'googleLogin']);

Route::post('auth/register', RegisterController::class);

Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/forgot-password', [PasswordResetLinkController::class, 'store']);

Route::middleware(['auth:sanctum', 'banned'])->group(function(){

    Route::post('auth/reset-password', [NewPasswordController::class, 'store'])->name('api.reset.password.post');

    Route::post('auth/verify-email-otp', [VerifyEmailController::class, '__invoke'])->name('api.otp.verification')->middleware(['throttle:6,1']);

    Route::post('auth/resend-verify-email-otp', [ResendVerifyOtpController::class, 'email'])->name('api.otp.verification.resend.email')->middleware(['throttle:6,1']);

    // Route::post('auth/resend-verify-whatsapp-otp',

    Route::post('auth/check-password', [UpdatePasswordController::class, 'check']);
    Route::post('auth/update-password', [UpdatePasswordController::class, 'update']);

    /*Verifikasi Nomor HP*/

    // Menyamakan kode otp di databse dengan otp yang dikirim ke whatsapp
    Route::post('auth/verify-mobile-number', [VerifyMobileController::class, 'verify'])->middleware(['throttle:6,1']);;

    Route::middleware('verified')->group(function(){
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::get('accomodations', [AccomdationController::class, 'index']);
        Route::post('accomodations/status', [AccomdationController::class, 'status']);
        Route::get('accomodations/{accomodation:name}/rooms', [AccomdationController::class, 'rooms']);

        Route::post('rooms/status', [RoomController::class, 'status']);

        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/{order}', [OrderController::class, 'show']);
        Route::post('orders/create', [OrderController::class, 'create']);
        Route::post('orders/checkout', [OrderController::class, 'checkout']);
        Route::get('orders/ticket/{order}', [OrderController::class, 'ticket']);
        Route::post('orders/update/status', [OrderController::class, 'updateStatus']);

        Route::get('payments/lists', [PaymentController::class, 'lists']);
        Route::get('payments/tax', [PaymentController::class, 'tax']);

        Route::post('payments/ewallet/create', [PaymentController::class, 'createEwallet']);
        Route::post('payments/ewallet/update-status', [PaymentController::class, 'updateStatusEwallet']);
        Route::post('payments/va/create', [PaymentController::class, 'createVirtualAccount']);
        Route::post('payments/va/pay', [PaymentController::class, 'virtualAccountPay']);

        Route::get('payments/methods', [PaymentMethodController::class, 'index']);

        Route::get('payments/methods/{name}', [PaymentMethodController::class, 'show']);

        Route::get('payments/methods/{name}/{type}', [PaymentMethodController::class, 'detail']);

        Route::get('refund/status/{refund}', [RefundController::class, 'status']);
        Route::get('refund/reason', [RefundController::class, 'reason']);
        Route::post('refund/{order}', [RefundController::class, 'refund']);
        Route::post('refund/confirm/{order}', [RefundController::class, 'confirm']);

        Route::get('refferrals/point', [RefferralController::class, 'getPointValue']);
        Route::post('refferrals/redeem', [RefferralController::class, 'redeem']);

        Route::post('reviews', [ReviewsController::class, 'create'])->name('api.review.create');
        Route::post('reviews/validate', [ReviewsController::class, 'validateUser'])->name('api.review.validate');

    });

    Route::post('auth/logout', [LoginController::class, 'logout']);

    Route::prefix('posts')->name('posts.')->group(function() {
        Route::get('', [PostController::class, 'index'])->name('index');
        Route::get('{id}', [PostController::class, 'show'])->name('show');
    });

    Route::prefix('category-posts')->name('category_posts.')->group(function() {
        Route::get('', [CategoryPostController::class, 'index'])->name('index');
        Route::get('{id}', [CategoryPostController::class, 'show'])->name('show');
    });

    Route::prefix('products')->name('products.')->group(function() {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('{id}', [ProductController::class, 'show'])->name('show');
        Route::post('redeem', [ProductController::class, 'redeem']);
    });

    Route::prefix('vouchers')->name('vouchers.')->group(function() {
        Route::get('', [VoucherController::class, 'index'])->name('index');
        Route::get('/user/used', [VoucherController::class, 'userVoucherUsed']);
        // Route::get('/user/unused', [VoucherController::class, 'userVoucherUnUsed']);
        Route::get('/user', [VoucherController::class, 'userVoucher']);
        Route::get('/all', [VoucherController::class, 'allVouchers']);
        Route::get('{id}', [VoucherController::class, 'show'])->name('show');
    });

    Route::prefix('points')->name('points.')->group(function() {
        Route::post('', [PoinController::class, 'store'])->name('store');
        Route::post('', [PoinController::class, 'store'])->name('store');
        Route::get('list', [PoinController::class, 'list'])->name('list');
         Route::get('list/detail/{id}', [PoinController::class, 'detail'])->name('detail');
    });

    Route::prefix('account')->name('account.')->group(function() {
        Route::get('', [AccountUserController::class, 'index'])->name('index');
        Route::put('update', [AccountUserController::class, 'update'])->name('update');
        Route::post('update/photo-profile', [AccountUserController::class, 'updatePhotoProfile']);
    });

    Route::get('offices', [OfficeController::class, 'index']);
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('notifications/categories', [NotificationController::class, 'categories']);
    Route::get('notifications/{id}', [NotificationController::class, 'show']);
    Route::post('notifications/markasread/{id}', [NotificationController::class, 'markAsRead']);

});

Route::get('privacy', [PrivacyController::class, 'index']);

Route::get('provinces', [RegencyController::class, 'showProvinces']);

Route::get('regencies/{id?}', [RegencyController::class, 'showRegencies'])->name('api.regencies.show');

Route::get('distritcs/{id?}', [RegencyController::class, 'showDistricts'])->name('api.districts.show');

Route::get('filters', [FilterController::class, 'index']);

Route::get('promotions', [PromotionController::class, 'index']);

Route::get('promotions/{promotion}', [PromotionController::class, 'show']);

Route::post('rooms/list', [RoomController::class, 'list'])->name('api.rooms.list');

Route::post('cb/payment/ewallet/status/ovo', [XenditCallbackController::class, 'ovo']);

Route::post('cb/payment/ewallet/status', [XenditCallbackController::class, 'ewallet']);

Route::post('cb/payment/va/status', [XenditCallbackController::class, 'virtualAccount']);

Route::get('playstore/link', [PlayStoreController::class, 'index']);
Route::get('appstore/link', [AppStoreController::class, 'index']);




