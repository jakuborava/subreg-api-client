<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

class Price
{
    public function __construct(
        public readonly float $amount,
        public readonly bool $premium,
        public readonly string $currency
    ) {
    }

    public static function fromSubregAPIResponse(array $priceData): Price
    {
        return new Price($priceData['amount'], $priceData['premium'], $priceData['currency']);
    }
}
