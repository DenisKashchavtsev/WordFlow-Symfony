<?php

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Event\EventInterface;

abstract class Aggregate
{
    public function __construct()
    {
    }

    private array $events = [];

    abstract public function getId(): string;

    public function popEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    protected function registerEvent(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}