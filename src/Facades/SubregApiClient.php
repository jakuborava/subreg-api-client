<?php

namespace Jakuborava\SubregApiClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jakuborava\SubregApiClient\SubregApiClient
 */
class SubregApiClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Jakuborava\SubregApiClient\SubregApiClient::class;
    }
}
