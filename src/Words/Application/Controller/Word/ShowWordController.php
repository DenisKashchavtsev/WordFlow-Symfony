<?php

namespace App\Words\Application\Controller\Word;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Query\Word\ShowWord\ShowWordQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/word-words/{id}', methods: ['GET'])]
class ShowWordController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        $query = new ShowWordQuery($request->get('id'));
        $category = $this->queryBus->execute($query);

        return new JsonResponse($category, Response::HTTP_OK);
    }
}