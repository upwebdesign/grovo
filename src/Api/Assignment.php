<?php

namespace Upwebdesign\Grovo\Api;

use Upwebdesign\Grovo\GrovoException;
use Upwebdesign\Grovo\Traits\Response as GrovoResponse;

/**
*
*/
class Assignment
{
    use GrovoResponse;

    /**
     * @var object
     */
    protected $api;

    /**
     * @param object $api
     */
    public function __construct($api)
    {
        $this->api = $api;
    }

    /**
     * @param  integer $page
     * @return array
     */
    public function all($page=1)
    {
        if (is_null($page) || ! is_numeric($page)) {
            throw new GrovoException('Please provide a page number!', 1);
        }
        return $this->handleResponse($this->api->getAssignments($page));
    }

    /**
     * @param  string $id
     * @return array
     */
    public function get($id=null)
    {
        if (is_null($id)) {
            throw new GrovoException('User ID for this request is invalid!', 1);
        }
        return $this->handleResponse($this->api->getUserAssignments($id));
    }
}