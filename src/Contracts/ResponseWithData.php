<?php

namespace Jakuborava\SubregApiClient\Contracts;

use Jakuborava\SubregApiClient\BaseResponse;

interface ResponseWithData
{
    public static function fromWedosClientResponse(BaseResponse $baseResponse): ResponseWithData;
}
