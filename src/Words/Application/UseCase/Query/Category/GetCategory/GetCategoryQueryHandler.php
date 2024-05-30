<?php

namespace App\Words\Application\UseCase\Query\Category\GetCategory;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Exception;

class GetCategoryQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(GetCategoryQuery $query): CategoryDTO
    {
        $category = $this->categoryRepository->find($query->id);

        if (!$category) {
            throw new Exception('Category not found');
        }

        return CategoryDTO::fromEntity($category);
    }
}