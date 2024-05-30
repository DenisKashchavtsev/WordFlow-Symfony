<?php

namespace App\Words\Application\UseCase\Command\CreateLearningHistory;

use App\Shared\Application\Command\CommandInterface;

class CreateLearningHistoryCommand implements CommandInterface
{
    public function __construct(public readonly array $wordIds, public readonly string $step)
    {
    }
}