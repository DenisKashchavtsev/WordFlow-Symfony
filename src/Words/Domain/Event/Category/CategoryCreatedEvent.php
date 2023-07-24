<?php

namespace App\Words\Domain\Event\Category;

use App\Shared\Domain\Event\EventInterface;

class CategoryCreatedEvent implements EventInterface
{
    public function __construct(public readonly string $wordId)
    {
    }
}