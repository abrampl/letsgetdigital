<?php

namespace App\Providers;

use App\Http\Support\SpikklClient;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class SpikklServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SpikklClient::class, function ($app) {
            return new SpikklClient($app['config']['spikkl']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SpikklClient::class];
    }
}
