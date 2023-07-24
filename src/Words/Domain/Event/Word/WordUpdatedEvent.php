<?php

namespace App\Words\Domain\Event\Word;

use App\Shared\Domain\Event\EventInterface;

class WordUpdatedEvent implements EventInterface
{
    public function __construct(public readonly string $wordId)
    {
    }
}