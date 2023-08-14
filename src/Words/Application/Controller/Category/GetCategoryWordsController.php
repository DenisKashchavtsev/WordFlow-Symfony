<?php

namespace App\Words\Application\Controller\Category;

use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\Query\Category\GetCategoryWords\GetCategoryWordsQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/api/word-categories/{id}/words', methods: ['GET'])]
class GetCategoryWordsController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        $query = new GetCategoryWordsQuery($request->get('id'), $request->get('page') ?? 1);

        $words = $this->serializer->serialize($this->queryBus->execute($query), 'json',
            [AbstractNormalizer::IGNORED_ATTRIBUTES => ['category']]);

        return new Response($words, Response::HTTP_OK);
    }
}