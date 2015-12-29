<?php

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */

return [
    'api' => 'http://api.grovo.com',
    'version' => '1.0',
    'client_id' => env('GROVO_ID'),
    'client_secret' => env('GROVO_SECRET'),
    'token' => null,
    'debug' => false
];