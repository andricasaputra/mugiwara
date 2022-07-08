<?php

namespace App\Providers;

use App\Contracts\PaymentServiceInterface;
use App\Services\Payments\EwalletPayment;
use App\Services\Payments\VirtualAccountPayment;
use Illuminate\Support\ServiceProvider;
use Xendit\Xendit;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
        $this->registerPaymentClass();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function registerPaymentClass()
    {
        $this->app->singleton(PaymentServiceInterface::class, function($app){
            if (request()->channel_category == 'EWALLET') {
                return new EwalletPayment;
            }elseif(request()->channel_category == 'VIRTUAL_ACCOUNT'){
                    return new VirtualAccountPayment;
            }
        });
    }
}
