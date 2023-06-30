<?php

namespace App\Shared\Domain\Entity;

use App\Shared\Domain\Event\EventInterface;

abstract class Aggregate
{
    private array $events = [];

    abstract public function getId(): string;

    public function popEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    protected function raiseEvent(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}