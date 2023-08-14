<?php

namespace App\Words\Application\Query\Category\ShowCategory;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Exception;

class ShowCategoryQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly WordRepositoryInterface     $wordRepository,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(ShowCategoryQuery $query): CategoryDTO
    {
        $category = $this->categoryRepository->find($query->id);

        if (!$category) {
            throw new Exception('Category not found');
        }

        return CategoryDTO::fromEntity($category);
    }
}