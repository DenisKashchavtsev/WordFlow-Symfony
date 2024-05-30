<?php

namespace App\Words\Infrastructure\Controller\Learning;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\UseCase\Command\CreateLearningHistory\CreateLearningHistoryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/learning-histories', methods: ['POST'])]
class CreateLearningHistoryController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreateLearningHistoryCommand($data['word_ids'], $data['step']);
        $category = $this->commandBus->execute($command);

        return new JsonResponse($category, 201);
    }
}