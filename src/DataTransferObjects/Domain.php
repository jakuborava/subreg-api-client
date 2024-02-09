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

    public static function fromSubregAPIResponse(array $responseData): Domain
    {
        //dd($responseData);
        return new Domain(
            $responseData['domain'],
            $responseData['contacts'],
            $responseData['hosts'],
            $responseData['delegated_hosts'] ?? [],
            $responseData['registrant'],
            ! blank($responseData['crDate']) ? Carbon::parse($responseData['crDate']) : null,
            ! blank($responseData['trDate']) ? Carbon::parse($responseData['trDate']) : null,
            ! blank($responseData['upDate']) ? Carbon::parse($responseData['upDate']) : null,
            Carbon::parse($responseData['exDate']),
            $responseData['authid'],
            $responseData['status'],
            (bool) $responseData['autorenew'],
            (bool) $responseData['premium'],
            (int) $responseData['price']
        );
    }
}
