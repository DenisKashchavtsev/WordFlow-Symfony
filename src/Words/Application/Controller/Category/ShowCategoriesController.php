<?php

namespace App\Words\Application\Controller\Category;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Query\Category\ShowCategories\ShowCategoriesQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/word-categories', methods: ['GET'])]
class ShowCategoriesController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        $query = new ShowCategoriesQuery($request->get('page') ?? 1);
        $categories = $this->serializer->serialize($this->queryBus->execute($query), 'json');

        return new Response($categories, Response::HTTP_OK);
    }
}