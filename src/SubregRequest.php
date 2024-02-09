<?php

namespace Jakuborava\SubregApiClient;

use Jakuborava\SubregApiClient\Exceptions\LoginFailedException;
use Jakuborava\SubregApiClient\Exceptions\RequestFailedException;
use SoapClient;
use SoapFault;

class SubregRequest
{
    /**
     * @throws LoginFailedException
     */
    public function login(): string
    {
        $params = [
            'data' => [
                'login' => config('subreg-api-client.user'),
                'password' => config('subreg-api-client.password'),
            ],
        ];

        try {
            $response = (new self())->call('Login', $params);
        } catch (LoginFailedException|RequestFailedException|SoapFault $e) {
            throw new LoginFailedException(
                'It was not possible to login to Subreg API. Exception: '.$e->getMessage()
            );
        }

        if (! isset($response['data']['ssid'])) {
            throw new LoginFailedException(
                'It was not possible to login to Subreg API. Response: '.json_encode($response)
            );
        }

        return $response['data']['ssid'];
    }

    /**
     * @throws RequestFailedException
     * @throws LoginFailedException
     */
    public function call(string $command, array $params): array
    {
        if ($command !== 'Login') {
            $token = $this->login();
            $params['data']['ssid'] = $token;
        }

        try {
            $client = new SoapClient(
                null,
                ['location' => config('subreg-api-client.location'), 'uri' => config('subreg-api-client.uri')]
            );
        } catch (SoapFault $e) {
            throw new RequestFailedException(
                'SOAP request failed. WSDL URI cannot be loaded! Exception: '.$e->getMessage()
            );
        }

        try {
            $response = $client->__soapCall($command, $params);
        } catch (SoapFault $e) {
            throw new RequestFailedException('SOAP request call failed. Exception: '.$e->getMessage());
        }

        if ($response['status'] === 'error') {
            throw new RequestFailedException(
                sprintf(
                    '%s. Code (major): %s, code (minor): %s, Response: %s',
                    $response['error']['errormsg'],
                    $response['error']['errorcode']['major'],
                    $response['error']['errorcode']['minor'],
                    json_encode($response)
                )
            );
        }

        return $response;
    }
}
