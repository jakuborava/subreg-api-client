<?php

namespace Jakuborava\SubregApiClient;

use Jakuborava\SubregApiClient\Endpoints\Credit;
use Jakuborava\SubregApiClient\Endpoints\DNS;
use Jakuborava\SubregApiClient\Endpoints\Domains;
use Jakuborava\SubregApiClient\Endpoints\Orders;

class SubregApiClient
{
    public function domains(): Domains
    {
        return new Domains;
    }

    public function credit(): Credit
    {
        return new Credit;
    }

    public function dns(): DNS
    {
        return new DNS;
    }

    public function orders(): Orders
    {
        return new Orders;
    }
}
