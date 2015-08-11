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

    // To update the config file with new token
    // File::put(app_path() . '/config/customization.php', "<?php\n return $data ;")

    /**
     * [__construct description]
     */
    public function __construct()
    {
        if (empty(config('grovo.token'))) {
            return $this->request($endpoint, [
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'grant_type' => 'client_credentials'
            ]);
        }
    }

}