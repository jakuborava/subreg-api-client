<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

use Carbon\Carbon;

class DomainMinimal
{
    protected function __construct(
        public readonly string $name,
        public readonly Carbon $expire,
        public readonly bool $autoRenew
    ) {
    }

    public static function fromSubregAPIResponse(array $responseData): DomainMinimal
    {
        return new DomainMinimal(
            $responseData['name'],
            Carbon::parse($responseData['expire']),
            (bool)$responseData['autorenew']
        );
    }
}
