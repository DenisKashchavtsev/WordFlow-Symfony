<?php

declare(strict_types=1);

namespace App\Users\Application\Controller;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Users\Application\Command\CreateUser\CreateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/auth/registration', methods: ['post'])]
class RegistrationController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreateUserCommand($data['name'], $data['email'], $data['password']);

        $user = $this->commandBus->execute($command);

        return new JsonResponse($user, 201);
    }
}