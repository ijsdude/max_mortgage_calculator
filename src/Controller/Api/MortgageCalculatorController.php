<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Form\MaximumMortgageByIncomeType;
use App\Service\ApiService;
use App\Service\MortgageCalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MortgageCalculatorController extends AbstractController
{
    public function __construct(
        private MortgageCalculatorService $mortgageCalculatorService,
        private ApiService $apiService
    ) {
    }

    #[Route('/calculate-by-income', methods: ['POST'])]
    public function calculateMortgage(Request $request): JsonResponse
    {
        $form = $this->createForm(MaximumMortgageByIncomeType::class);
        $requestData = json_decode($request->getContent(), true);
        $form->submit($requestData, false);

        if (!$form->isValid()) {
            return $this->apiService->createFormErrorResponse($form);
        }

        $maximumMortgageByIncomeDTO = $form->getData();

        try {
            $maximumMortgage = $this->mortgageCalculatorService->getMaximumMortgageByIncome($maximumMortgageByIncomeDTO);
        } catch (\Exception $exception) {
            $message = sprintf(
                'Fetching the maximum mortgage failed with the following exception message: %s',
                $exception->getMessage()
            );

            return new JsonResponse(
                [
                    'message' => $message
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return new JsonResponse($maximumMortgage);
    }
}
