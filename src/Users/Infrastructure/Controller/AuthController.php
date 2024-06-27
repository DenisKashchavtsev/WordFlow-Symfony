<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Shared\Application\Event\EventBusInterface;
use App\Shared\Infrastructure\Attribute\RequestBody;
use App\Shared\Infrastructure\Attribute\Valid;
use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Users\Application\DTO\UserCreateDTO;
use App\Users\Application\UseCase\UserUseCaseInteractor;
use App\Users\Domain\Event\UserCreatedEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    public function __construct(
        public readonly UserUseCaseInteractor $userUseCaseInteractor
    )
    {
    }

    #[Route('/api/auth/registration', methods: ['post'])]
    public function registration(#[RequestBody, Valid] UserCreateDTO $userCreateDTO, EventBusInterface $eventBus): JsonResponse
    {
        $eventBus->execute(new UserCreatedEvent('1'));

        return new JsonResponse($this->userUseCaseInteractor->createUser($userCreateDTO), Response::HTTP_CREATED);
    }
}