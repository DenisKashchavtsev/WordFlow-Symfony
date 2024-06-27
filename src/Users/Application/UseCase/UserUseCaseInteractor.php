<?php

namespace App\Users\Application\UseCase;

use App\Shared\Application\Command\CommandBusInterface;
use App\Users\Application\DTO\UserCreateDTO;
use App\Users\Application\UseCase\Command\CreateUser\CreateUserCommand;

class UserUseCaseInteractor
{
    public function __construct(
        private readonly CommandBusInterface $commandBus
    )
    {
    }

    public function createUser(UserCreateDTO $userCreateDTO)
    {
        $command = new CreateUserCommand($userCreateDTO);

        return $this->commandBus->execute($command);
    }
}