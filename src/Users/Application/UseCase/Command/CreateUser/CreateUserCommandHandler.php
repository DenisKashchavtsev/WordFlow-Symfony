<?php

namespace App\Users\Application\UseCase\Command\CreateUser;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserFactory $userFactory
    )
    {
    }

    public function __invoke(CreateUserCommand $createUserCommand): UserDTO
    {
        $userCreateDTO = $createUserCommand->userCreateDTO;
        $user = $this->userFactory->create($userCreateDTO->name, $userCreateDTO->email, $userCreateDTO->password);

        $this->userRepository->add($user);

        return UserDTO::fromEntity($user);
    }
}