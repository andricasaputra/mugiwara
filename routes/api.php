<?php

use App\Http\Controllers\Api\Auth\GoogleApiController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResendVerifyOtpController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/google/', [GoogleApiController::class, 'googleLogin']);

Route::post('auth/register', RegisterController::class);

Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/forgot-password', [PasswordResetLinkController::class, 'store']);

// Route::get('auth/reset-password/{token}', [NewPasswordController::class, 'create'])->name('api.reset.password');


Route::middleware('auth:sanctum')->group(function(){

    Route::post('auth/reset-password/{token}', [NewPasswordController::class, 'store'])->name('api.reset.password.post');

    Route::post('verify-email-otp', [VerifyEmailController::class, '__invoke'])
                ->middleware(['throttle:6,1'])
                ->name('api.otp.verification');

    Route::post('auth/resend-verify-email-otp', [ResendVerifyOtpController::class, 'email'])
                ->middleware(['throttle:6,1'])
                ->name('api.otp.verification.resend.email');

    Route::post('auth/resend-verify-whatsapp-otp', [ResendVerifyOtpController::class, 'whatsapp'])
                ->middleware(['throttle:6,1'])
                ->name('api.otp.verification.resend.whatsapp');

    Route::middleware('verified')->group(function(){
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::post('auth/logout', [LoginController::class, 'logout']);
});


