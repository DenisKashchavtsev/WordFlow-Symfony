<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Event;

use App\Shared\Domain\Event\EventHandlerInterface;
use App\Users\Domain\Event\UserCreatedEvent;

final class UserCreatedEventHandler implements EventHandlerInterface
{
    public function __invoke(UserCreatedEvent $event): string
    {
        sleep(10);
        return '11';
    }
}
