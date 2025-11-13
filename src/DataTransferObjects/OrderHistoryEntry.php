<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

use Carbon\CarbonImmutable;

readonly class OrderHistoryEntry
{
    public function __construct(
        public CarbonImmutable $date,
        public string $text,
        public int $orderId,
        public float $sum,
        public float $credit
    ) {}

    public static function fromSubregAPIResponse(array $data): OrderHistoryEntry
    {
        return new OrderHistoryEntry(
            CarbonImmutable::parse($data['date']),
            $data['text'],
            (int) $data['order'],
            (float) $data['sum'],
            (float) $data['credit']
        );
    }
}
