<?php

namespace App\Shared\Application\Validator;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class NotBlank implements ValidationRule
{

    public function validate(mixed $value): bool
    {
        return !empty($value);
    }

    public function getErrorMessage(mixed $property): string
    {
        return 'The ' . $property->name . ' field cannot be empty!';
    }
}