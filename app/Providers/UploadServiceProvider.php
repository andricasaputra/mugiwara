<?php

namespace App\Providers;

use App\Contracts\UploadServiceInterface;
use App\Uploads\FacilityIconUploadService;
use App\Uploads\PhotoProfileUploadService;
use App\Uploads\PromotionUploadImageService;
use App\Uploads\RoomUploadImageService;
use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploadServiceInterface::class, function($app){
            if(request()->image_type == 'room'){
                return new RoomUploadImageService;
            }elseif(request()->image_type == 'facility'){
                return new FacilityIconUploadService;
            }elseif(request()->hasFile('photo_profile')){
                 return new PhotoProfileUploadService;
            }elseif(request()->hasFile('promotion_image')){
                 return new PromotionUploadImageService;
            }

            throw new \Exception("Upload service not supported!");
        });
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
}
