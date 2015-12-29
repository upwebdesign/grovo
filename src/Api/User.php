<?php namespace Upwebdesign\Grovo\Api;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */
use Upwebdesign\Grovo\GrovoException;
use Upwebdesign\Grovo\Http\HttpException;

/**
*
*/
class User
{
    /**
     * @var string
     */
    protected $endpoint = 'users';

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
        return $this->api->getUsers($page);
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
        return $this->api->showUser($id);
    }

    /**
     * [create description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function create($data=[])
    {
        if (empty($data) || ! is_array($data)) {
            throw new HttpException('You must supply user information to create a user!', 1);
        }
        $data['data'] = [
            'type' => 'users',
            'attributes' => $data
        ];
        // return $this->request($endpoint, $data);
    }

    /**
     * [update description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function update($id, $data=[])
    {
        if (empty($data) || ! is_array($data)) {
            throw new HttpException('You must supply user information to create a user!', 1);
        }
        $data['data'] = [
            'type' => 'users',
            'attributes' => $data
        ];
        // return $this->method('PATCH')->request(sprintf('%s/%s', $endpoint, $id), $data);
    }

    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id=null)
    {
        if (is_null($id) || ! is_numeric($id)) {
            throw new HttpException('User ID for this request is invalid!', 1);
        }
        // return $this->method('DELETE')->request(sprintf('%s/%s', $endpoint, $id));
    }
}