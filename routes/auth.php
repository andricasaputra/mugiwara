<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\MobileNumberVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyMobileController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['guest'])->group(function () {
    

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('admin/register', [RegisteredUserController::class, 'create'])
        ->middleware('admin')
        ->name('admin.register');

    Route::post('admin/register', [RegisteredUserController::class, 'store']) 
        ->middleware('admin')
        ->name('admin.register.post');;

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('notify-verify-mobile', [MobileNumberVerificationNotificationController::class, '__invoke'])
                ->name('verification.mobile');

   

    Route::get('verify-mobile/{id}', [VerifyMobileController::class, 'index'])
                ->middleware(['throttle:4,1'])
                ->name('verification.mobile.verify');

    Route::post('send-verify-mobile', [VerifyMobileController::class, 'store'])
                ->middleware(['throttle:4,1'])
                ->name('verification.mobile.verify.send');

    Route::post('resend-verify-mobile', [VerifyMobileController::class, 'resend'])
                ->middleware(['throttle:4,1'])
                ->name('verification.mobile.verify.resend');

    Route::post('resend-verify-email', [VerifyEmailController::class, 'resend'])
                ->middleware(['throttle:4,1'])
                ->name('verification.email.verify.resend');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::post('mobile/verification-notification', [MobileNumberVerificationNotificationController::class, 'store'])
                ->middleware('throttle:4,1')
                ->name('verification.mobile.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
