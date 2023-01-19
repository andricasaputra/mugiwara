<?php

use App\Http\Controllers\Admin\RegencyController;
use App\Http\Controllers\Api\AccomdationController;
use App\Http\Controllers\Api\AccountUserController;
use App\Http\Controllers\Api\AppStoreController;
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
use App\Http\Controllers\Api\DeleteReasonController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OfficeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\PlayStoreController;
use App\Http\Controllers\Api\PoinController;
use App\Http\Controllers\Api\PostCommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostLikeController;
use App\Http\Controllers\Api\PostVisitController;
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
use App\Http\Controllers\Api\XenditCallbackOvoController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HubungiKamiController;
use App\Http\Controllers\MitraGabungController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('auth/google/', [GoogleApiController::class, 'googleLogin']);

Route::post('auth/register', RegisterController::class);

Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/forgot-password', [PasswordResetLinkController::class, 'store']);

Route::get('accomodations', [AccomdationController::class, 'index'])->name('api.accomodation.index');
Route::get('accomodations/{name}/rooms', [AccomdationController::class, 'rooms'])->name('api.accomodation.rooms');

Route::middleware(['auth:sanctum', 'banned', 'deleted'])->group(function(){

    Route::post('auth/reset-password', [NewPasswordController::class, 'store'])->name('api.reset.password.post');

    Route::post('auth/verify-email-otp', [VerifyEmailController::class, '__invoke'])->name('api.otp.verification')->middleware(['throttle:6,1']);

    Route::post('auth/resend-verify-email-otp', [ResendVerifyOtpController::class, 'email'])->name('api.otp.verification.resend.email')->middleware(['throttle:6,1']);

    Route::post('auth/check-password', [UpdatePasswordController::class, 'check']);
    Route::post('auth/update-password', [UpdatePasswordController::class, 'update']);

    /*Verifikasi Nomor HP*/

    // Menyamakan kode otp di databse dengan otp yang dikirim ke whatsapp
    Route::post('auth/verify-mobile-number', [VerifyMobileController::class, 'verify'])->middleware(['throttle:6,1']);

    Route::middleware('verified')->group(function(){

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('accomodations/status', [AccomdationController::class, 'status']);
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

    // Post Comment
    Route::prefix('post/comments')->group(function() {

        Route::get('{post}', [PostCommentController::class, 'index']);
        Route::post('add/{post}', [PostCommentController::class, 'store']);
        Route::put('update/{post}/{comment}', [PostCommentController::class, 'update']);
        Route::delete('delete/{comment}', [PostCommentController::class, 'destroy']);
        
    });

    //Post Like
    Route::prefix('post/likes')->group(function() {

        //Route::get('{post}', [PostLikeController::class, 'index']);
        Route::post('add/{post}', [PostLikeController::class, 'store']);
        //Route::put('update/{post}/{like}', [PostLikeController::class, 'update']);
        Route::delete('delete/{like}', [PostLikeController::class, 'destroy']);
        
    });

    //Post Visitors
    Route::prefix('post/visitors')->group(function() {

        //Route::get('{post}', [PostLikeController::class, 'index']);
        Route::post('add/{post}', [PostVisitController::class, 'store']);
        //Route::put('update/{post}/{Visit}', [PostVisitController::class, 'update']);
        Route::delete('delete/{visitor}', [PostVisitController::class, 'destroy']);
        
    });

    Route::prefix('category-posts')->name('category_posts.')->group(function() {
        Route::get('', [CategoryPostController::class, 'index'])->name('index');
        Route::get('{id}', [CategoryPostController::class, 'show'])->name('show');
    });

    Route::prefix('products')->name('products.')->group(function() {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('{id}', [ProductController::class, 'show'])->name('show');
        Route::post('redeem', [ProductController::class, 'redeem']);
        Route::get('update/{product_user_id}', [ProductController::class, 'updateStatus']);
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

        Route::get('delete/reason', [DeleteReasonController::class, 'index']);
        Route::post('delete', [DeleteReasonController::class, 'store']);
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

// Route::post('cb/payment/ewallet/ovo', [XenditCallbackOvoController::class, 'ovo']);

Route::post('cb/payment/ewallet/status', [XenditCallbackController::class, 'ewallet']);

Route::post('cb/payment/va/status', [XenditCallbackController::class, 'virtualAccount']);

Route::get('payments/cb/successfully', [\App\Http\Controllers\Api\PaymentController::class, 'successfully']);

Route::get('payments/cb/failed', [\App\Http\Controllers\Api\PaymentController::class, 'failed']);

Route::get('playstore/link', [PlayStoreController::class, 'index'])->name('playstorelink');
Route::get('appstore/link', [AppStoreController::class, 'index'])->name('appstorelink');




