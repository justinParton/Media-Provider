<?php

namespace GBFIC\MediaProvider;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadMigrationsFrom(__DIR__.'../migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->publishes([
        	__DIR__.'config/config.php' => config_path('mediaproviders.php'),
        	__DIR__.'config/graphql.php' => config_path('mediaproviders_GraphQL.php'),
    	]);
    }
}
