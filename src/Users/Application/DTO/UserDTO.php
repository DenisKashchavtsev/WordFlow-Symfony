<?php

namespace App\Users\Application\DTO;

use App\Users\Domain\Aggregate\User;

class UserDTO
{
    public function __construct(public readonly string $id, public readonly string $name, public readonly string $email)
    {
    }

    public static function fromEntity(User $user): UserDTO
    {
        return new self($user->getId(), $user->getName(), $user->getEmail());
    }
}