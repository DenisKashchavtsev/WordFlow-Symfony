<?php

namespace App\Words\Application\Service;

use App\Words\Domain\Aggregate\LearningStep;
use ReflectionClass;

class LearningFindStepService
{
    public function byValue(string|int $value): ?LearningStep
    {
        $reflectionClass = new ReflectionClass(LearningStep::class);
        $constants = $reflectionClass->getConstants();

        foreach ($constants as $constant) {
            if ($constant->value === intval($value)) {
                return constant("App\Words\Domain\Aggregate\LearningStep::$constant->name");
            }
        }
        return null;
    }
}