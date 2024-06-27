<?php

namespace App\Users\Application\UseCase\Command\CreateUser;

use App\Shared\Application\Command\CommandInterface;
use App\Users\Application\DTO\UserCreateDTO;

class CreateUserCommand implements CommandInterface
{
    public function __construct(public readonly UserCreateDTO $userCreateDTO)
    {
    }
}