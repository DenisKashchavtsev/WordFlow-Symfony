<?php

namespace App\Words\Infrastructure\Database\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class LearningStepType extends Type
{
    public const NAME = 'learning_step';

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value->getValue();
    }

    public function convertToPHPValue(mixed $step, AbstractPlatform $platform)
    {
        return $step->value;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        // TODO: Implement getSQLDeclaration() method.
    }
}