<?php

namespace App\Words\Application\Controller\Category;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Command\Category\UpdateCategory\UpdateCategoryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/word-categories/{id}', methods: ['PUT'])]
class UpdateCategoryController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new UpdateCategoryCommand($request->get('id'), $data['name']);
        $category = $this->commandBus->execute($command);

        return new JsonResponse($category, 200);
    }
}