<?php

namespace Upwebdesign\Grovo;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */

use Illuminate\Support\ServiceProvider;
use Grovo\Api\Client\GrovoApi;
use Carbon\Carbon;
use Cache;

/**
 *
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
        $this->package('upwebdesign/grovo', 'grovo');
    }

    /**
     * [register description]
     * @return [type] [description]
     */
    public function register()
    {
        $app = $this->app;

        // Used with Facade
        $app->singleton('grovo', function() {
            $client_id = $app['config']->get('grovo::client_id');
            $client_secret = $app['config']->get('grovo::client_secret');
            $debug = $app['config']->get('grovo::debug');
            $access_token = ! Cache::has('grovo:access_token') ?: Cache::get('grovo:access_token');
            $api = new GrovoApi($client_id, $client_secret, $access_token, function($new_token) {
                // Global cache!!!
                $expiresAt = Carbon::now()->addDay();
                Cache::put('grovo:access_token', $new_token, $expiresAt);
            });
            // If not debugging set to live api and auth URLs
            if ( ! $debug) {
                $api->setApiUrl('https://api.grovo.com');
                $api->setAuthUrl('https://auth.grovo.com');
            }
            return $api;
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