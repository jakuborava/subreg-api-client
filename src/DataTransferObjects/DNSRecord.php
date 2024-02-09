<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

class DNSRecord
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $type,
        public readonly string $content,
        public readonly int $priority,
        public readonly int $ttl
    ) {
    }

    public static function fromSubregAPIResponse(array $responseData): DNSRecord
    {
        return new DNSRecord(
            $responseData['id'],
            $responseData['name'],
            $responseData['type'],
            $responseData['content'],
            $responseData['prio'],
            $responseData['ttl']
        );
    }
}
