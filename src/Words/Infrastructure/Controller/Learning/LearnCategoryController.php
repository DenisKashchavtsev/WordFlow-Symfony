<?php

namespace App\Words\Infrastructure\Controller\Learning;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\UseCase\Query\Category\LearnCategory\LearnCategoryQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/learn-category/{id}', methods: ['GET'])]
class LearnCategoryController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $query = new LearnCategoryQuery($request->get('id'));

        $learningSession = $this->queryBus->execute($query);

        return new JsonResponse($learningSession, Response::HTTP_OK);
    }
}