<?php

namespace App\Users\Domain\Service;

use App\Users\Domain\Aggregate\User;

interface UserPasswordHasherInterface
{
    public function hash(User $user, string $password): string;
}