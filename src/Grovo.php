<?php

namespace Upwebdesign\Grovo;

use Upwebdesign\Grovo\GrovoException;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

/**
*
*/
class Grovo
{
    /**
     * [$debug description]
     * @var boolean
     */
    protected $debug = false;

    /**
     * [$api description]
     * @var string
     */
    protected $api = 'http://api.grovo.com/token';

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
     * [request description]
     * @param  [type] $uri     [description]
     * @param  [type] $body    [description]
     * @param  [type] $headers [description]
     * @param  [type] $method  [description]
     * @return [type]          [description]
     */
    public function request($uri, $body, $headers, $method)
    {
        try
        {
            $client = new Client();
            // if ($this->debug)
            // {
            //     $logPlugin = new \Guzzle\Plugin\Log\LogPlugin(
            //         $this->httpLogAdapter,
            //         \Guzzle\Log\MessageFormatter::DEBUG_FORMAT
            //     );
            //     $client->addSubscriber($logPlugin);
            // }
            $request = $client->createRequest($method, $uri, $headers, $body);
            $response = $request->send();
            return $response->json();
        }
        catch (ClientErrorResponseException $e)
        {
            throw new GrovoException($e);
        }
    }
}