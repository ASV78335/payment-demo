<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class RequestValidationException extends \RuntimeException
{
    public function __construct(private readonly ConstraintViolationListInterface $violations)
    {
        parent::__construct('Validation failed');
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}