<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->resolving(function($object, $class) {
            \Log::debug('resolving: ' . get_class($object));
        });
        $this->app->afterResolving(function($object, $class) {
            \Log::debug('after resolving: ' . get_class($object));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
