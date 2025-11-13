<?php

namespace Jakuborava\SubregApiClient\Endpoints;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Jakuborava\SubregApiClient\DataTransferObjects\OrderHistoryEntry;
use Jakuborava\SubregApiClient\Exceptions\LoginFailedException;
use Jakuborava\SubregApiClient\Exceptions\RequestFailedException;
use Jakuborava\SubregApiClient\Responses\OrderResponse;
use Jakuborava\SubregApiClient\SubregRequest;

class Orders
{
    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function make(string $domain, string $type, array $orderParams): int
    {
        $params = ['data' => ['order' => ['domain' => $domain, 'type' => $type, 'params' => $orderParams]]];

        $response = (new SubregRequest)->call('Make_Order', $params);

        return $response['data']['orderid'];
    }

    /**
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function info(int $orderID): OrderResponse
    {
        $response = (new SubregRequest)->call('Info_Order', ['data' => ['order' => $orderID]]);

        return OrderResponse::fromSubregAPIResponse($response['data']['order']);
    }

    /**
     * @return Collection<int, OrderHistoryEntry>
     * @throws LoginFailedException
     * @throws RequestFailedException
     */
    public function history(CarbonImmutable $from, CarbonImmutable $to): Collection
    {
        $response = (new SubregRequest)->call(
            'Get_Accountings',
            ['data' => ['from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]]
        );

        return (new Collection($response['data']['accounting']))
            ->map(fn(array $order) => OrderHistoryEntry::fromSubregAPIResponse($order));
    }
}
