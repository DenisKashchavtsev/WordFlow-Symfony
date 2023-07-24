<?php

namespace App\Words\Application\Controller\Category;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Command\Category\DeleteCategory\DeleteCategoryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/word-categories/{id}', methods: ['DELETE'])]
class DeleteCategoryController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $command = new DeleteCategoryCommand($request->get('id'));
        $this->commandBus->execute($command);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}