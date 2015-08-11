<?php

namespace Upwebdesign\Grovo;

use Upwebdesign\Grovo\GrovoException;
use Upwebdesign\Grovo\Api\User;

/**
* Grovo documentation
* http://docs.grovo.apiary.io
* $grovo->user()->get($id);
*/
class Grovo
{
    /**
     * [user description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function user(User $user)
    {
        return $user;
    }

}