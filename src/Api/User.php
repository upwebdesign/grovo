<?php

namespace Upwebdesign\Grovo\Api

use Upwebdesign\Grovo\Http\GuzzleClient;

/**
*
*/
class User extends GuzzleClient
{
    /**
     * [$endpoint description]
     * @var string
     */
    private $endpoint = 'users';

    /**
     * [get description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function get($id=null)
    {
        if (is_null($id) || ! is_numeric($id)) {
            throw new HttpException('User ID for this request is invalid!', 1);
        }
        return $this->request(sprintf('%s/%s', $endpoint, $id));
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
        ]
        return $this->request($endpoint, $data);
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
        ]
        return $this->method('PATCH')->request(sprintf('%s/%s', $endpoint, $id), $data);
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
        return $this->method('DELETE')->request(sprintf('%s/%s', $endpoint, $id));
    }
}