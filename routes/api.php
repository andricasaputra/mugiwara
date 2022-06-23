<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResenVerifyEmailController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', RegisterController::class);

Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/forgot-password', [PasswordResetLinkController::class, 'store']);

Route::post('auth/forgot-password', [PasswordResetLinkController::class, 'store']);

Route::get('auth/reset-password/{token}', [NewPasswordController::class, 'create'])->name('api.reset.password');

Route::post('auth/reset-password', [NewPasswordController::class, 'store'])->name('api.reset.password.post');

Route::middleware('auth:sanctum')->group(function(){

    Route::post('verify-email-otp', [VerifyEmailController::class, '__invoke'])
                ->middleware(['throttle:6,1'])
                ->name('api.otp.verification');

    Route::post('resend-verify-email-otp', [ResenVerifyEmailController::class, '__invoke'])
                ->middleware(['throttle:6,1'])
                ->name('api.otp.verification.resend');

    Route::middleware('verified')->group(function(){
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::post('auth/logout', [LoginController::class, 'logout']);
});


