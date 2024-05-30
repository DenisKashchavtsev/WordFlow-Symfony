<?php

namespace App\Words\Infrastructure\Controller;

use App\Shared\Infrastructure\Attribute\RequestBody;
use App\Shared\Infrastructure\Attribute\Valid;
use App\Shared\Infrastructure\Symfony\AbstractController;
use App\Words\Application\DTO\CategoryCreateDTO;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Application\UseCase\CategoryUseCaseInteractor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function __construct(public CategoryUseCaseInteractor $interactor)
    {
        parent::__construct();
    }

    #[Route('/api/word-categories', methods: ['GET'])]
    public function list(Request $request): Response
    {
        $categories = $this->interactor->getCategoriesByAuthUser(
            $request->query->get('page', 1));

        return new JsonResponse($categories, Response::HTTP_OK);
    }

    #[Route('/api/word-categories/{id}', methods: ['GET'])]
    public function show(Request $request): JsonResponse
    {
        $category = $this->interactor->getCategory($request->get('id'));

        return new JsonResponse($category, Response::HTTP_OK);
    }

    #[Route('/api/word-categories', methods: ['POST'])]
    public function create(#[RequestBody, Valid] CategoryCreateDTO $categoryUpdateDTO): JsonResponse
    {
        return new JsonResponse(
            $this->interactor->crateCategory($categoryUpdateDTO),
            Response::HTTP_CREATED);
    }

    #[Route('/api/word-categories', methods: ['PUT'])]
    public function update(#[RequestBody, Valid] CategoryDTO $categoryDTO): JsonResponse
    {
        return new JsonResponse($this->interactor->updateCategory($categoryDTO), 200);
    }

    #[Route('/api/word-categories/{id?}', methods: ['DELETE'])]
    public function delete(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->interactor->deleteCategories(
            $request->get('id') ? [$request->get('id')] : $data['ids']);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    #[Route('/api/word-categories/{id}/words', methods: ['GET'])]
    public function categoryWords(Request $request): Response
    {
        return new JsonResponse($this->interactor->getCategoryWords(
            $request->get('id'),
            $request->get('page') ?? 1
        ), Response::HTTP_OK);
    }
}