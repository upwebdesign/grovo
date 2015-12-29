<?php

namespace Upwebdesign\Grovo\Traits;

use Upwebdesign\Grovo\GrovoException;

trait Response
{
    public function handleRespoonse($response=null)
    {
        if (empty($response)) {
            throw new GrovoException("Invalid Response", 1);
        }
        if ( ! empty($response['errors'])) {
            throw new GrovoException($response['errors'][0]['title'], 1);
        }
        if ( ! empty($response['data']['attributes'])) {
            return ['data' => $response['data']['attributes']];
        }
        return $response;
    }
}