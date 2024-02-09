<?php

namespace Jakuborava\SubregApiClient\Responses;

use Carbon\Carbon;

class OrderResponse
{
    public function __construct(
        public readonly int $id,
        public readonly string $domain,
        public readonly string $type,
        public readonly string $status,
        public readonly int $errorCode,
        public readonly Carbon $lastUpdate,
        public readonly string $message,
        public readonly bool $payed,
        public readonly float $amount,
    ) {
    }

    public static function fromSubregAPIResponse(array $responseData): OrderResponse
    {
        return new OrderResponse(
            $responseData['id'],
            $responseData['domain'],
            $responseData['type'],
            $responseData['status'],
            $responseData['errorcode'],
            Carbon::parse($responseData['lastupdate']),
            $responseData['message'],
            $responseData['payed'],
            $responseData['amount']
        );
    }
}
