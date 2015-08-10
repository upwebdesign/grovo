<?php

namespace Upwebdesign\Grovo;

use \Illuminate\Support\ServiceProvider;

/**
*
*/
class GrovoServiceProvider extends ServiceProvider
{
    /**
     * [register description]
     * @return [type] [description]
     */
    public function register()
    {
        $this->app->bind('grovo', function($app) {
            return new Grovo;
        });
    }

    /**
     * [boot description]
     * @return [type] [description]
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/config.php';
        $this->publishes([$configPath => config_path('config.php')], 'config');

        include sprintf('%s/Http/routes.php', __DIR__);
    }
}