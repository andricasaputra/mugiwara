<?php

namespace App\Providers;

use App\Contracts\PaymentServiceInterface;
use App\Contracts\PaymentTypenterface;
use App\Models\Payments\VirtualAccount;
use App\Services\Payments\EwalletPayment;
use App\Services\Payments\Type\Ewallet;
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
        $this->registerPayentTypeClass();
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

    protected function registerPayentTypeClass()
    {
        $this->app->singleton(PaymentTypenterface::class, function($app){
            if (request()->channel_category == 'EWALLET') {
                return new Ewallet;
            }elseif(request()->channel_category == 'VIRTUAL_ACCOUNT'){
                    return new VirtualAccount;
            }
        });
    }
}
