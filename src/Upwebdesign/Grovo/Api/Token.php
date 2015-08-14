<?php namespace Upwebdesign\Grovo\Api;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */

use Upwebdesign\Grovo\Http\GuzzleClient;
use Upwebdesign\Grovo\GrovoException;
use Upwebdesign\Grovo\Http\HttpException;
use File;

/**
 * This is ready for testing
 */
class Token extends GuzzleClient
{
    /**
     * [$endpoint description]
     * @var string
     */
    protected $endpoint = 'token';

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $response = $this->request($this->endpoint, [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials'
        ]);
        $config = Config::get('grovo');
        $this->token = $config['token'] = $response['access_token'];
        try {
            // Needs working on
            // File::disk('config')->put('grovo.php', sprintf("<?php\n\nreturn %s ;", var_export($config, 1)));
        } catch (Exception $e) {
            throw new GrovoException("Failed to store token in grovo.config file!", 1);
        }
    }

}