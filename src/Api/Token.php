<?php

namespace Upwebdesign\Grovo\Api

use Upwebdesign\Grovo\Http\GuzzleClient;

/**
*
*/
class Token extends GuzzleClient
{
    /**
     * [$endpoint description]
     * @var string
     */
    private $endpoint = 'token';

    /**
     * [__construct description]
     */
    public function __construct()
    {
        if ( ! is_null($token = config('grovo.token', null))) {
            return $token;
        }
        $response = $this->request($endpoint, [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials'
        ]);
        $data = config('grovo');
        $data['token'] = $response['access_token'];
        $data = var_export($data, 1);
        try {
            File::put(app_path() . '/config/grovo.php', "<?php\n return $data ;");
        } catch (Exception $e) {
            throw new GrovoException("Failed to store token in grovo.config file!", 1);
        }
        return $data['token'];
    }

}