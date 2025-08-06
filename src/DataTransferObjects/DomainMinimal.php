<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

use Carbon\Carbon;
use Jakuborava\SubregApiClient\Contracts\DTO;

class DomainMinimal implements DTO
{
    protected function __construct(
        public readonly string $name,
        public readonly Carbon $expire,
        public readonly bool $autoRenew
    ) {}

    public static function fromSubregAPIResponse(array $data): DomainMinimal
    {
        return new DomainMinimal(
            $data['name'],
            Carbon::parse($data['expire']),
            (bool) $data['autorenew']
        );
    }
}
