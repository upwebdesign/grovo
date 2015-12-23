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
use Grovo\Api\Client\GrovoApi;
use Carbon\Carbon;
use Cache;

/**
* Grovo documentation
* https://grovo-api.readme.io/v1.0/docs
* http://docs.grovo.apiary.io
*/
class Grovo extends GrovoApi
{
    private $instance;

    public function __construct()
    {
        // Get access token from cache, or false
        $access_token = ! Cache::has('grovo:access_token') ? false : Cache::get('grovo:access_token');
        // Set up GrovoApi
        // $this->instance = new GrovoApi(config('grovo.client_id'), config('grovo.client_secret'), $access_token, function($new_token) {
        //     $expiresAt = Carbon::now()->addDay();
        //     Cache::put('grovo:access_token', $new_token, $expiresAt); // Gobal
        // });
        // If not debugging set to live api and auth URLs
        if ( ! config('grovo.debug')) {
            $this->setApiUrl('https://api.grovo.com');
            $this->setAuthUrl('https://api.grovo.com');
            // $this->instance->setAuthUrl('https://auth.grovo.com');
        }
        parent::__construct(config('grovo.client_id'), config('grovo.client_secret'), $access_token, function($new_token) {
            $expiresAt = Carbon::now()->addDay();
            Cache::put('grovo:access_token', $new_token, $expiresAt); // Gobal
        });
    }

    /**
     * [getInstance description]
     * @return [type] [description]
     */
    // protected function getInstance()
    // {
    //     return $this->instance;
    // }
}