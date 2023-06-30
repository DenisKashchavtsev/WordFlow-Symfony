<?php

namespace App\Words\Domain\Event;

use App\Shared\Domain\Event\EventInterface;

class WordCreatedEvent implements EventInterface
{
    public function __construct(public readonly string $wordId)
    {
    }
}