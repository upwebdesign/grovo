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
* When publishing via packages/upwebdesign/grovo/src
* php artisan config:publish upwebdesign/grovo --path=app/packages/upwebdesign/grovo/src/config
*/
class GrovoServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * [boot description]
     * @return [type] [description]
     */
    public function boot()
    {
        // dd($this->guessPackagePath());
        $this->package('upwebdesign/grovo', 'grovo');
        // Register Commands
        $this->commands('grovo:requestToken');
    }

    /**
     * [register description]
     * @return [type] [description]
     */
    public function register()
    {
        $this->app->bind('grovo', function() {
            return new Grovo;
        });

        $this->app->bindShared('grovo:requestToken', function ($app) {
            return new RequestToken();
        });
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