<?php

namespace App\Shared\Application\Validator;

use ReflectionClass;

class Validator
{
    public function validate(object $object): array
    {
        $errors = [];

        $reflectionClass = new ReflectionClass($object);

        foreach ($reflectionClass->getProperties() as $property) {
            foreach ($property->getAttributes() as $attribute) {
                $attributeInstance = $attribute->newInstance();

                if ($attributeInstance instanceof ValidationRule) {

                    if ($property->isInitialized($object)) {
                        $value = $property->getValue($object);
                    }

                    if (!isset($value) || !$attributeInstance->validate($value)) {
                        $errors[] = $attributeInstance->getErrorMessage($property);
                    }
                }
            }

            unset($value);
        }

        return $errors;
    }
}