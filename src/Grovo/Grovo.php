<?php namespace Upwebdesign\Grovo;

/**
 * This file is part of Upwebdesign\Grovo,
 * a Laravel package to integrate with Grovo
 *
 * @license MIT
 * @package Upwebdesign\Grovo
 */

use Upwebdesign\Grovo\GrovoException;
use Upwebdesign\Grovo\Api\User;

/**
* Grovo documentation
* http://docs.grovo.apiary.io
*/
class Grovo
{
    /**
     * [$user description]
     * @var object
     */
    private $user = null;

    /**
     * [user description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function user()
    {
        if (is_null($this->user)) {
            return new User;
        }
        return $this->user;
    }

}
