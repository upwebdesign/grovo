<?php

namespace Upwebdesign\Grovo\Http

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

/**
*
*/
class GuzzleClient
{
    /**
     * [$api description]
     * @var string
     */
    protected $api = 'http://api.grovo.com';

    /**
     * [$client_id description]
     * @var string
     */
    protected $client_id = '';

    /**
     * [$client_secret description]
     * @var string
     */
    protected $client_secret = '';

    /**
     * [$token description]
     * @var [type]
     */
    private $token;

    /**
     * [$method description]
     * @var string
     */
    private $method = 'POST';

    /**
     * [$debug description]
     * @var [type]
     */
    protected $debug;

    /**
     * [__construct description]
     * @param Token $token [description]
     */
    public function __construct(Token $token)
    {
        $this->client_id = config('grovo.client_id');
        $this->client_secret = config('grovo.client_secret');
        $this->token = $token;
    }

    /**
     * [request description]
     * @param  [type] $uri              [description]
     * @param  [type] $args             [description]
     * @param  array  $endpoint_headers [description]
     * @return [type]                   [description]
     */
    public function request($uri, $args=null)
    {
        $url = sprintf('%s/%s', $this->api, $uri);
        $headers = [
            'API-version' => '1.0',
            'Content-Type' => 'application/json'
        ]
        $auth = ! empty($this->token) ? ['Authorization' => sprintf('Bearer %s', $this->token)] : []
        $headers = array_merge($headers, $auth);
        try {
            $client = new Client();
            $request = $client->createRequest($this->method, $url, $headers, $body);
            $response = $request->send();
            return $response->json();
        } catch (ClientErrorResponseException $e) {
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
}