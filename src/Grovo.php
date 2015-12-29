<?php

namespace Upwebdesign\Grovo;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with GrovoApi
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */
use Upwebdesign\Grovo\GrovoException;
use Upwebdesign\Grovo\Api\Assignment;
use Upwebdesign\Grovo\Api\User;
use Grovo\Api\Client\GrovoApi;
use Carbon\Carbon;
use Cache;

/**
* Grovo documentation
* https://grovo-api.readme.io/v1.0/docs
* http://docs.grovo.apiary.io
*/
class Grovo
{
    private $api;

    public function __construct()
    {
        // Get access token from cache, or false
        $access_token = ! Cache::has('grovo:access_token') ? false : Cache::get('grovo:access_token');
        // Set up GrovoApi
        $this->api = new GrovoApi(config('grovo.client_id'), config('grovo.client_secret'), $access_token, function($new_token) {
            $expiresAt = Carbon::now()->addDay();
            Cache::put('grovo:access_token', $new_token, $expiresAt); // Gobal
        });
        // If not debugging set to live api and auth URLs
        if ( ! config('grovo.debug')) {
            $this->api->setApiUrl('https://api.grovo.com');
            $this->api->setAuthUrl('https://api.grovo.com');
            // $this->api->setAuthUrl('https://auth.grovo.com');
        }
    }

    /**
     * @return Upwebdesign\Grovo\Api\User
     */
    public function user()
    {
        return new User($this->api);
    }

    /**
     * @return Upwebdesign\Grovo\Api\Assignment
     */
    public function assignment()
    {
        return new Assignment($this->api);
    }
}