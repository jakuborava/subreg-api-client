<?php

namespace Jakuborava\SubregApiClient\Endpoints;

use Jakuborava\SubregApiClient\DataTransferObjects\Domain;
use Jakuborava\SubregApiClient\DataTransferObjects\DomainMinimal;
use Jakuborava\SubregApiClient\Exceptions\LoginFailedException;
use Jakuborava\SubregApiClient\Exceptions\RequestFailedException;
use Jakuborava\SubregApiClient\Responses\DomainCheckResponse;
use Jakuborava\SubregApiClient\SubregRequest;
use Illuminate\Support\Collection;

class Domains
{
    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     * @return Collection<DomainMinimal>
     */
    public function list(): Collection
    {
        $response = (new SubregRequest())->call('Domains_List', []);

        return collect($response['data']['domains'])->map(function (array $domain) {
            return DomainMinimal::fromSubregAPIResponse($domain);
        });
    }

    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function info(string $domain): Domain
    {
        $params = [
            'data' => [
                'domain' => $domain
            ]
        ];

        $response = (new SubregRequest())->call('Info_Domain', $params);

        return Domain::fromSubregAPIResponse($response['data']);
    }


    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function check(string $domain): DomainCheckResponse
    {
        $params = [
            'data' => [
                'domain' => $domain
            ]
        ];

        $response = (new SubregRequest())->call('Check_Domain', $params);

        return DomainCheckResponse::fromSubregAPIResponse($response['data']);
    }

    /**
     * @param array $params Any other parameters, see https://subreg.cz/manual/?cmd=TLD_Valid&tld=YOUR_TLD
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function create(string $domain, string $adminContact, array $params, int $period = 1): int
    {
        $body = [
            'period' => $period,
            'registrant' => ['id' => $adminContact],
            'contacts' => ['admin' => ['id' => $adminContact]],
            'ns' => [
                'hosts' => [
                    'ns.gransy.com',
                    'ns2.gransy.com',
                    'ns3.gransy.com',
                    'ns4.gransy.com',
                    'ns5.gransy.com'
                ]

            ],
        ];

        $body['params'] = $params;

        return (new Orders())->make($domain, 'Create_Domain', $body);
    }

    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function renew(string $domain, int $period = 1): int
    {
        $params = [
            'period' => $period,
        ];

        return (new Orders())->make($domain, 'Renew_Domain', $params);
    }
}
