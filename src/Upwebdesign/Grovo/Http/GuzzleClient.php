<?php namespace Upwebdesign\Grovo\Http;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */

use Upwebdesign\Grovo\Api\Token;
use Upwebdesign\Grovo\GrovoException;
use Upwebdesign\Grovo\Http\HttpException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Config;

/**
*
*/
class GuzzleClient
{
    /**
     * [$api description]
     * @var string
     */
    private $api;

    /**
     * [$version description]
     * @var string
     */
    private $version;

    /**
     * [$client_id description]
     * @var string
     */
    protected $client_id;

    /**
     * [$client_secret description]
     * @var string
     */
    protected $client_secret;

    /**
     * [$token description]
     * @var string
     */
    protected $token;

    /**
     * [$method description]
     * @var string
     */
    private $method = 'POST';

    /**
     * [$debug description]
     * @var boolean
     */
    protected $debug;

    /**
     * [$endpoint description]
     * @var string
     */
    protected $endpoint;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->api = Config::get('grovo::api', 'http://api.grovo.com');
        $this->version = Config::get('grovo::version', '1.0');
        $this->client_id = Config::get('grovo::client_id');
        $this->client_secret = Config::get('grovo::client_secret');
        $this->token = Config::get('grovo::token');
        $this->debug = Config::get('grovo::debug');
    }

    /**
     * [request description]
     * @param  [type] $uri  [description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function request($uri, $args=null)
    {
        dd($this->version);
        dd(Config::get('grovo::version'));
        $headers = [
            'API-version' => $this->version,
            'Content-Type' => 'application/json'
        ];
        $auth = ! empty($this->token) ? ['Authorization' => sprintf('Bearer %s', $this->token)] : [];
        $headers = array_merge($headers, $auth);
        try {
            $client = new Client(['base_uri' => $this->api]);
            $response = $client->get($uri, [
                'headers' => $headers,
                'body' => $args
            ]);
            // $response = $request->send();
            $data = $response->json();
            if (isset($data['errors'])) {
                $error = $errors[1];
                throw new HttpException(sprintf('code: %s :: %s', $error['code'], $error['title']));
            }
        } catch (ClientException $e) {
            throw new HttpException($e);
        }
    }

    /**
     * [method description]
     * @param  [type] $method [description]
     * @return [type]         [description]
     */
    protected function method($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * [getToken description]
     * @return [type] [description]
     */
    public function getToken()
    {
        return $this->token;
    }
}