<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

readonly class Host
{
    public function __construct(public string $hostname, public ?string $ipv4 = null, public ?string $ipv6 = null) {}

    public function toArray(): array
    {
        $result = ['hostname' => $this->hostname];

        if (! is_null($this->ipv4) && trim($this->ipv4) !== '') {
            $result['ipv4'] = $this->ipv4;
        }

        if (! is_null($this->ipv6) && trim($this->ipv6) !== '') {
            $result['ipv6'] = $this->ipv6;
        }

        return $result;
    }
}
