<?php declare(strict_types=1);

namespace App\Helper;

use Symfony\Component\Form\FormInterface;

class FormErrorHelper
{
    public static function getNormalizedFormErrors(FormInterface $form): array
    {
        $normalized = [
            'errors' => self::convertFormErrorsToArray($form)
        ];
        $children = [];
        if (!empty($form->all())) {
            foreach ($form->all() as $childForm) {
                $childData = self::getNormalizedFormErrors($childForm);
                $children[$childForm->getName()] = $childData;
            }
            $normalized['children'] = $children;
        }

        return $normalized;
    }

    private static function convertFormErrorsToArray(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[] = [
                'message' => $error->getMessage(),
                'cause' => $error->getCause(),
            ];
        }

        return $errors;
    }
}
