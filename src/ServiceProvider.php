<?php

namespace Zeek\LaravelGoogleAds;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('google-ads', function ($app) {
            return new GoogleAds($app['config']->get('googleads.accounts')[0]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/googleads.php' => config_path('googleads.php'),
        ]);
    }
}
