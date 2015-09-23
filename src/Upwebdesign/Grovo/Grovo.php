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
* http://docs.grovo.apiary.io
*/
class Grovo
{
    private $instance;

    public function __construct($client_id, $client_secret, $debug)
    {
        // Get access token from cache, or false
        $access_token = ! Cache::has('grovo:access_token') ? false : Cache::get('grovo:access_token');
        // Set up GrovoApi
        $this->instance = new GrovoApi($client_id, $client_secret, $access_token, function($new_token) {
            $expiresAt = Carbon::now()->addDay();
            Cache::put('grovo:access_token', $new_token, $expiresAt); // Gobal
        });
        // If not debugging set to live api and auth URLs
        if ( ! $debug) {
            $this->instance->setApiUrl('https://api.grovo.com');
            $this->instance->setAuthUrl('https://auth.grovo.com');
        }
    }

    /**
     * [getInstance description]
     * @return [type] [description]
     */
    protected function getInstance()
    {
        return $this->instance;
    }
}