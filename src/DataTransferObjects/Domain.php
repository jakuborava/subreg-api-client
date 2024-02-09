<?php

namespace Jakuborava\SubregApiClient\DataTransferObjects;

use Carbon\Carbon;

class Domain extends DomainMinimal
{
    protected function __construct(
        string $domain,
        public readonly array $contacts,
        public readonly array $hosts,
        public readonly array $delegatedHosts,
        public readonly array $registrant,
        public readonly ?Carbon $creationDate,
        public readonly ?Carbon $lastTransferDate,
        public readonly ?Carbon $lastUpdateDate,
        Carbon $expireDate,
        public readonly string $authID,
        public readonly array $status,
        bool $autoRenew,
        public readonly bool $premium,
        public readonly int $price
    ) {
        parent::__construct($domain, $expireDate, $autoRenew);
    }

    public static function fromSubregAPIResponse(array $data): Domain
    {
        //dd($data);
        return new Domain(
            $data['domain'],
            $data['contacts'],
            $data['hosts'],
            $data['delegated_hosts'] ?? [],
            $data['registrant'],
            !blank($data['crDate']) ? Carbon::parse($data['crDate']) : null,
            !blank($data['trDate']) ? Carbon::parse($data['trDate']) : null,
            !blank($data['upDate']) ? Carbon::parse($data['upDate']) : null,
            Carbon::parse($data['exDate']),
            $data['authid'],
            $data['status'],
            (bool)$data['autorenew'],
            (bool)$data['premium'],
            (int)$data['price']
        );
    }
}
