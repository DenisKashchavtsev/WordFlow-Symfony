<?php

namespace App\Users\Domain\Repository;

use App\Users\Domain\Aggregate\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function findByEmail(string $email): ?User;
}