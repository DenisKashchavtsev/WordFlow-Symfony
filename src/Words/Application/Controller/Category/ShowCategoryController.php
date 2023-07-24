<?php

namespace App\Words\Application\Controller\Category;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Query\Category\ShowCategory\ShowCategoryQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/word-categories/{id}', methods: ['GET'])]
class ShowCategoryController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $query = new ShowCategoryQuery($request->get('id'));
        $category = $this->queryBus->execute($query);

        return new JsonResponse($category, Response::HTTP_OK);
    }
}