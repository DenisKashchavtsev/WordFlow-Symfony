<?php

namespace App\Users\Domain\Event;

use App\Shared\Domain\Event\EventInterface;

class UserCreatedEvent implements EventInterface
{
    public function __construct(public readonly string $userId)
    {
    }

    public function getType(): string
    {
        return 'user.created';
    }

}