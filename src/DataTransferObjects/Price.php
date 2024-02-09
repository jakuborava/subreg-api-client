<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

use Jakuborava\SubregApiClient\Contracts\DTO;

class Price implements DTO
{
    public function __construct(
        public readonly float $amount,
        public readonly bool $premium,
        public readonly string $currency
    ) {
    }

    public static function fromSubregAPIResponse(array $data): Price
    {
        return new Price($data['amount'], $data['premium'], $data['currency']);
    }
}
