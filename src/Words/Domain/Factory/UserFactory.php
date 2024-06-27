<?php

namespace App\Words\Domain\Factory;

use App\Words\Domain\Aggregate\User;

class UserFactory
{
    public static function create(string $globalUserId): User
    {
        return new User($globalUserId);
    }
}