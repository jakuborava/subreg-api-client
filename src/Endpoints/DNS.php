<?php

namespace Jakuborava\SubregApiClient\Endpoints;

use Illuminate\Support\Collection;
use Jakuborava\SubregApiClient\DataTransferObjects\DNSRecord;
use Jakuborava\SubregApiClient\Exceptions\LoginFailedException;
use Jakuborava\SubregApiClient\Exceptions\RequestFailedException;
use Jakuborava\SubregApiClient\SubregRequest;

class DNS
{
    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function list(string $domain): Collection
    {
        $response = (new SubregRequest)->call('Get_DNS_Zone', ['data' => ['domain' => $domain]]);

        return collect($response['data']['records'])->map(function (array $record) {
            return DNSRecord::fromSubregAPIResponse($record);
        });
    }

    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function addRecord(
        string $domain,
        string $name,
        string $type,
        string $content,
        int $ttl,
        int $priority = 0
    ): int {
        $params = [
            'data' => [
                'domain' => $domain,
                'record' => [
                    'name' => $name,
                    'type' => $type,
                    'content' => $content,
                    'ttl' => $ttl,
                    'prio' => $priority,
                ],
            ],
        ];

        $response = (new SubregRequest)->call('Add_DNS_Record', $params);

        return $response['data']['record_id'];
    }

    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function modifyRecord(
        string $domain,
        int $id,
        string $type,
        string $content,
        int $ttl,
        int $priority = 0
    ): void {
        $params = [
            'data' => [
                'domain' => $domain,
                'record' => [
                    'id' => $id,
                    'type' => $type,
                    'content' => $content,
                    'ttl' => $ttl,
                    'prio' => $priority,
                ],
            ],
        ];

        (new SubregRequest)->call('Modify_DNS_Record', $params);
    }

    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function deleteRecord(string $domain, int $id): void
    {
        $params = [
            'data' => [
                'domain' => $domain,
                'record' => [
                    'id' => $id,
                ],
            ],
        ];

        (new SubregRequest)->call('Delete_DNS_Record', $params);
    }

    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function addDNSZone(string $domain, string $template): void
    {
        $params = [
            'data' => [
                'domain' => $domain,
                'template' => $template,
            ],
        ];

        (new SubregRequest)->call('Add_DNS_Zone', $params);
    }
}
