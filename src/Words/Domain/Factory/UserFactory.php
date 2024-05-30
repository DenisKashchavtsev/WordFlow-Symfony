<?php

namespace App\Words\Domain\Factory;

use App\Words\Domain\Entity\User;

class UserFactory
{
    public static function create(string $globalUserId): User
    {
        return new User($globalUserId);
    }
}