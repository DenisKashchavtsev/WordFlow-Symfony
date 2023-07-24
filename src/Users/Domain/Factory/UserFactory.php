<?php

namespace App\Users\Domain\Factory;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(string $name, string $email, string $password): User
    {
        $user = new User($name, $email);
        $user->setPassword($password, $this->passwordHasher);

        return $user;
    }
}