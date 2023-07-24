<?php

namespace App\Words\Application\Command\CreateLearningHistory;

use App\Shared\Application\Command\CommandInterface;

class CreateLearningHistoryCommand implements CommandInterface
{
    public function __construct(public readonly string $wordId, public readonly string $step)
    {
    }
}