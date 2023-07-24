<?php

namespace App\Words\Application\Controller\Word;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Command\Word\CreateWord\CreateWordCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/words', methods: ['POST'])]
class CreateWordController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreateWordCommand($data['categoryId'], $data['source'], $data['translate']);
        $word = $this->commandBus->execute($command);

        return new JsonResponse($word, 201);
    }
}