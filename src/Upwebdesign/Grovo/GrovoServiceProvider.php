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

        $this->app->bindShared('grovo:requestToken', function ($app) {
            return new RequestToken();
        });
    }

    /**
     * [boot description]
     * @return [type] [description]
     */
    public function boot()
    {
        $this->package('upwebdesign/grovo', 'grovo');
        // $this->package('upwebdesign/grovo', 'grovo', __DIR__.'/../');
        // Register Commands
        $this->commands('grovo:requestToken');
    }

    /**
     * [provides description]
     * @return [type] [description]
     */
    public function provides()
    {
        // return [
        //     'grovo:requestToken'
        // ];
    }
}