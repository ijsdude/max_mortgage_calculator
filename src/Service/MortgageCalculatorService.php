<?php declare(strict_types=1);

namespace App\Service;

use App\Connector\HypotheekBondConnector;
use App\DTO\MaximumMortgageByIncome;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MortgageCalculatorService
{
    public function __construct(
        private HypotheekBondConnector $connector
    ) {
    }

    public function getMaximumMortgageByIncome(MaximumMortgageByIncome $maximumMortgageByIncomeDTO): array
    {
        $client = $this->connector->initializeClient();
        try {
            $response = $client->request('GET', '/calculation/v1/mortgage/maximum-by-income', [
                'query' => [
                    'nhg' => $maximumMortgageByIncomeDTO->isNhg() ? 'true' : 'false',
                    'old_student_loan_regulation' => $maximumMortgageByIncomeDTO->isOldStudentLoanRegulation() ?
                        'true' : 'false',
                    'private_lease_duration' => $maximumMortgageByIncomeDTO->getPrivateLeaseDuration(),
                    'duration' => $maximumMortgageByIncomeDTO->getDuration(),
                    'percentage' => $maximumMortgageByIncomeDTO->getPercentage(),
                    'rateFixation' => $maximumMortgageByIncomeDTO->getRateFixation(),
                    'notDeductible' => $maximumMortgageByIncomeDTO->getNotDeductible(),
                    'groundRent' => $maximumMortgageByIncomeDTO->getGroundRent(),
                    'person' => [
                        [
                            'income' => $maximumMortgageByIncomeDTO->getPerson1()?->getIncome(),
                            'age' => $maximumMortgageByIncomeDTO->getPerson1()?->getAge(),
                            'dateOfBirth' => $maximumMortgageByIncomeDTO->getPerson1()?->getDateOfBirth()?->format(
                                'yyyy-mm-dd'
                            ),
                            'alimony' => $maximumMortgageByIncomeDTO->getPerson1()?->getAlimony(),
                            'loans' => $maximumMortgageByIncomeDTO->getPerson1()?->getLoans(),
                            'studentLoans' => $maximumMortgageByIncomeDTO->getPerson1()?->getStudentLoans(),
                            'studentLoanStartDate' => $maximumMortgageByIncomeDTO->getPerson1()
                                ?->getStudentLoanStartDate()?->format('yyyy-mm-dd'),
                        ],
                        [
                            'income' => $maximumMortgageByIncomeDTO->getPerson2()?->getIncome(),
                            'age' => $maximumMortgageByIncomeDTO->getPerson2()?->getAge(),
                            'dateOfBirth' => $maximumMortgageByIncomeDTO->getPerson2()?->getDateOfBirth()?->format(
                                'yyyy-mm-dd'
                            ),
                            'alimony' => $maximumMortgageByIncomeDTO->getPerson2()?->getAlimony(),
                            'loans' => $maximumMortgageByIncomeDTO->getPerson2()?->getLoans(),
                            'studentLoans' => $maximumMortgageByIncomeDTO->getPerson2()?->getStudentLoans(),
                            'studentLoanStartDate' => $maximumMortgageByIncomeDTO->getPerson2()
                                ?->getStudentLoanStartDate()?->format('yyyy-mm-dd'),
                        ],
                    ],
                ]
            ]);

            return json_decode($response->getContent(), true);
        } catch (
            ClientExceptionInterface | RedirectionExceptionInterface |
            ServerExceptionInterface | TransportExceptionInterface $exception
        ) {
            // TODO:: add logging
            throw new \RuntimeException(
                sprintf(
                    'Fetching maximum mortgage did result in a %s exception: %s',
                    get_class($exception),
                    $exception->getMessage()
                )
            );
        }
    }

    // TODO:: Add functionality to calculate maximum mortgage by value
    public function getMaximumMortgageByValue(): array
    {
        $client = $this->connector->initializeClient();

        $client->request('GET', '/calculation/v1/mortgage/maximum-by-value', []);

        return [];
    }
}
