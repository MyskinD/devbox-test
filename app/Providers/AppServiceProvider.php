<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Grabber\Services\Contracts\GrabberServiceInterface::class,
            \App\Grabber\Services\GrabberService::class
        );

        $this->app->bind(
            \App\Grabber\Services\Contracts\CarsServiceInterface::class,
            \App\Grabber\Services\CarsService::class
        );

        $this->app->bind(
            \App\Grabber\Repositories\Contracts\CarsRepositoryInterface::class,
            \App\Grabber\Repositories\CarsRepository::class
        );
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
