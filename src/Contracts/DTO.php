<?php

namespace Jakuborava\SubregApiClient\Contracts;

interface DTO
{
    public static function fromWedosResponseData(array $data): DTO;
}
