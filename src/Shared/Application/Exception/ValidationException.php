<?php

namespace App\Shared\Application\Exception;

class ValidationException extends \RuntimeException
{
    protected $code = 422;

    public function __construct(private readonly array $violations)
    {
        parent::__construct('Validation failed');
    }

    public function getViolations(): array
    {
        return $this->violations;
    }
}