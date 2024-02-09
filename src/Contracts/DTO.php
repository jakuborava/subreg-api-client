<?php

namespace Jakuborava\SubregApiClient\Contracts;

interface DTO
{
    public static function fromSubregAPIResponse(array $data): DTO;
}
