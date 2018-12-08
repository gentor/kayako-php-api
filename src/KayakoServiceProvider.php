<?php

namespace Gentor\Kayako;


use Illuminate\Support\ServiceProvider;

class KayakoServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('kayako', function ($app) {
            return new KayakoService($app['config']['kayako']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['kayako'];
    }

}