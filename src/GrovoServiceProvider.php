<?php namespace Upwebdesign\Grovo;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */

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
        $this->registerBindings();
    }

    /**
     * [boot description]
     * @return [type] [description]
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/grovo.php');
        $this->publishes([$source => config_path('grovo.php')], 'config');
    }

    /**
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('grovo', function($app) {
            return new Grovo;
        });

        $this->app->alias('grovo', Grovo::class);
    }

    /**
     * [provides description]
     * @return [type] [description]
     */
    public function provides()
    {
        return [
            'grovo'
        ];
    }
}