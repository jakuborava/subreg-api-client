<?php

namespace Jakuborava\SubregApiClient\Responses;

use Jakuborava\SubregApiClient\DataTransferObjects\Price;

class DomainCheckResponse
{
    protected function __construct(
        public readonly string $name,
        public readonly bool $available,
        public readonly Price $price,
        public readonly Price $priceRenew,
        public readonly Price $priceTransfer,
        public readonly string $existingClaimID
    ) {}

    public static function fromSubregAPIResponse(array $responseData): DomainCheckResponse
    {
        return new DomainCheckResponse(
            $responseData['name'],
            $responseData['avail'],
            Price::fromSubregAPIResponse($responseData['price']),
            Price::fromSubregAPIResponse($responseData['price_renew']),
            Price::fromSubregAPIResponse($responseData['price_transfer']),
            $responseData['existing_claim_id'] ?? ''
        );
    }
}
