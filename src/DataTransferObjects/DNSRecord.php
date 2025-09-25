<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

use Jakuborava\SubregApiClient\Contracts\DTO;

class DNSRecord implements DTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $type,
        public readonly string $content,
        public readonly int $priority,
        public readonly int $ttl
    ) {}

    public static function fromSubregAPIResponse(array $data): DNSRecord
    {
        return new DNSRecord(
            $data['id'],
            $data['name'],
            $data['type'],
            $data['content'],
            $data['prio'],
            $data['ttl']
        );
    }
}
