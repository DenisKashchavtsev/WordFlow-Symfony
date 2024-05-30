<?php

namespace App\Words\Application\UseCase\Query\Category\GetCategories;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Application\DTO\ListDTO;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use Exception;

class GetCategoriesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(GetCategoriesQuery $query): ListDTO
    {
        $paginator = $query->ownerId ?
            $this->categoryRepository->findByUser($query->ownerId, $query->page) :
            $this->categoryRepository->findAll();

        $categories = array_map(fn($entity) => CategoryDTO::fromEntity($entity), $paginator->getData());

        return new ListDTO($categories, $paginator->getResultCount(), $paginator->getTotalPages());
    }
}