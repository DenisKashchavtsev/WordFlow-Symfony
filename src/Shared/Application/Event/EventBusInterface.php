<?php

namespace App\Shared\Application\Event;

use App\Shared\Domain\Event\EventInterface;

interface EventBusInterface
{
    public function execute(EventInterface ...$event): void;
}