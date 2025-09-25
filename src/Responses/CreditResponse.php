<?php

namespace Jakuborava\SubregApiClient\Responses;

class CreditResponse
{
    public function __construct(
        public readonly float $amount,
        public readonly float $threshold,
        public readonly string $currency,
        public readonly float $users
    ) {}

    public static function fromSubregAPIResponse(array $responseData): CreditResponse
    {
        return new CreditResponse(
            $responseData['amount'],
            $responseData['threshold'],
            $responseData['currency'],
            $responseData['users']
        );
    }
}
