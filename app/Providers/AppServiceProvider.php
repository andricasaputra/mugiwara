<?php

namespace App\Providers;

use App\Contracts\NotificationInterface;
use App\Models\User;
use App\Notifications\sendResetLinkEmailNotification;
use App\Notifications\sendResetLinkWhatsapplNotification;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerResetLinkNotificationClass();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }

    protected function registerResetLinkNotificationClass()
    {
        $this->app->bind(NotificationInterface::class, function($app){
            if(request()->has('email')){
                $user = User::whereEmail(request('email'))->first();
                if(is_null($user)) throw new \Exception('User tidak ditemukan');
                $user?->notify(new sendResetLinkEmailNotification($user));
            }else{
                $user = User::whereMobileNumber(request('mobile_number'))->first();
                if(is_null($user)) throw new \Exception('User tidak ditemukan');
                $user?->notify(new sendResetLinkWhatsapplNotification($user));
            }
        });
    }
}
