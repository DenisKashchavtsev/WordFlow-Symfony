<?php

namespace App\Shared\Application\Validator;

interface ValidationRule
{
    public function validate(mixed $value): bool;
    public function getErrorMessage(mixed $property): string;
}