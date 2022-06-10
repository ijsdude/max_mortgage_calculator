<?php declare(strict_types=1);

namespace App\Connector;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HypotheekBondConnector
{
    public const HOST = 'https://api.hypotheekbond.nl';

    public function __construct(
        private HttpClientInterface $client,
        private string $apiKey
    ) {
    }

    public function initializeClient(): HttpClientInterface
    {
        return $this->client->withOptions(
            [
                'base_uri' => self::HOST,
                'headers' => [
                    'x-api-key' => $this->apiKey
                ]
            ]
        );
    }
}

