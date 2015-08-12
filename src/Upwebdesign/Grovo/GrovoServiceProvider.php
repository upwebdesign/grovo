<?php namespace Upwebdesign\Grovo;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */

use Illuminate\Support\ServiceProvider;

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

        $this->app->bindShared('grovo:token', function ($app) {
            return new Console\Commands\RequestToken();
        });
    }

    /**
     * [boot description]
     * @return [type] [description]
     */
    public function boot()
    {
        $this->package('upwebdesign/grovo', 'grovo');
        // Register Commands
        $this->commands('grovo:token');
    }

    /**
     * [provides description]
     * @return [type] [description]
     */
    public function provides()
    {
        return [
            'grovo:token'
        ];
    }
}