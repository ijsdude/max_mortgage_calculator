<?php declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MortgageCalculatorControllerTest extends WebTestCase
{
    private const RESOURCE_PATH = __DIR__ . '/Resources/';

    public function testItGetsMaximumMortgageByIncomeWithCorrectInput()
    {
        $validMaximumMortgageResponse = file_get_contents(
            self::RESOURCE_PATH . '/validMaximumMortgageResponse.json'
        );

        $mockClient = new MockHttpClient(
            [
                new MockResponse(
                    $validMaximumMortgageResponse,
                    ['http_code' => 200]
                ),
            ]
        );
        $client = self::createClient();
        $client->getContainer()->set(HttpClientInterface::class, $mockClient);

        $client->request(
            'POST',
            '/calculate-by-income',
            [],
            [],
            [],
            json_encode(
                [
                    'percentage' => 1.5001,
                    "person1" => [
                        'income' => 50000
                    ]
                ],
                JSON_THROW_ON_ERROR
            )
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);

        // Adding a json_decode so both have the same format
        $this->assertSame(
            json_decode($validMaximumMortgageResponse, true),
            json_decode($client->getResponse()->getContent(), true)
        );
    }

    public function testItFailsGetMaximumMortgageByIncomeWithIncorrectInput()
    {
        $formMissingPercentageBadRequestResponse = file_get_contents(
            self::RESOURCE_PATH . '/formMissingPercentageBadRequestResponse.json'
        );

        $mockClient = new MockHttpClient(
            [
                new MockResponse(
                    $formMissingPercentageBadRequestResponse,
                    ['http_code' => 200]
                ),
            ]
        );
        $client = self::createClient();
        $client->getContainer()->set(HttpClientInterface::class, $mockClient);

        $client->request(
            'POST',
            '/calculate-by-income',
            [],
            [],
            [],
            json_encode(
                [
                    "person1" => [
                        'income' => 50000,
                    ]
                ],
                JSON_THROW_ON_ERROR
            )
        );

        $this->assertResponseStatusCodeSame(400);

        // Adding a json_decode so both have the same format
        $this->assertSame(
            json_decode($formMissingPercentageBadRequestResponse, true),
            json_decode($client->getResponse()->getContent(), true)
        );
    }
}
