<?php declare(strict_types=1);

namespace App\Service;

use App\Helper\FormErrorHelper;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiService
{
    public function createFormErrorResponse(FormInterface $form): JsonResponse
    {
        return $this->createBadRequestResponse('Form validation failed', FormErrorHelper::getNormalizedFormErrors($form));
    }

    public function createBadRequestResponse(string $errorMessage, ?array $violations = null): JsonResponse
    {
        $responseData = [
            'error' => $errorMessage,
        ];

        if (is_array($violations)) {
            $responseData['violations'] = $violations;
        }

        return new JsonResponse(
            $responseData,
            Response::HTTP_BAD_REQUEST
        );
    }
}

