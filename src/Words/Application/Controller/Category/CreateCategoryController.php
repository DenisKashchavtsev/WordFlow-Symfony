<?php

namespace App\Words\Application\Controller\Category;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Command\Category\CreateCategory\CreateCategoryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/word-categories', methods: ['POST'])]
class CreateCategoryController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreateCategoryCommand($data['name']);
        $category = $this->commandBus->execute($command);

        return new JsonResponse($category, 201);
    }
}