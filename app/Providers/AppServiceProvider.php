<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\ApiConnectionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(ApiConnectionService::class, function ($app){
        //     return new ApiConnectionService();
        // });
       
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
