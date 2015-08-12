<?php namespace Upwebdesign\Grovo;

use Upwebdesign\Grovo\GrovoException;
use Upwebdesign\Grovo\Api\User;
use Upwebdesign\Grovo\Api\Token;

/**
* Grovo documentation
* http://docs.grovo.apiary.io
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

    /**
     * [token description]
     * @param  Token  $token [description]
     * @return [type]        [description]
     */
    public function token(Token $token)
    {
        return $token;
    }

}