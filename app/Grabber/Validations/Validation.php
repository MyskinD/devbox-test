<?php

namespace App\Grabber\Validations;

use \Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class Validation
{
    /**
     * @param $value
     * @param string $field
     */
    protected function isNotNull($value, string $field): void
    {
        if (!$value) {
            throw new BadRequestHttpException('The field `' . mb_strtoupper($field) . '` must not be empty');
        }
    }

    /**
     * @param string $pattern
     * @param $value
     * @param string $field
     */
    protected function isRegExp(string $pattern, $value, string $field): void
    {
        if (!preg_match($pattern, $value)) {
            throw new BadRequestHttpException('Enter the correct field `' . mb_strtoupper($field) . '`');
        }
    }
}
