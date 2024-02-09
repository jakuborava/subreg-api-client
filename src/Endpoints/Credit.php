<?php

namespace Jakuborava\SubregApiClient\Endpoints;

use Jakuborava\SubregApiClient\Exceptions\LoginFailedException;
use Jakuborava\SubregApiClient\Exceptions\RequestFailedException;
use Jakuborava\SubregApiClient\Responses\CreditResponse;
use Jakuborava\SubregApiClient\SubregRequest;

class Credit
{
    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function info(): CreditResponse
    {
        $response = (new SubregRequest())->call('Get_Credit', []);

        return CreditResponse::fromSubregAPIResponse($response['data']['credit']);
    }
}
