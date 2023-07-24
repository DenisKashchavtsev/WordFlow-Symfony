<?php

namespace App\Words\Application\Command\Category\UpdateCategory;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use Exception;

class UpdateCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(UpdateCategoryCommand $updateCategoryCommand): CategoryDTO
    {
        $category = $this->categoryRepository->find($updateCategoryCommand->id);

        if (!$category) {
            throw new Exception('Category not found');
        }

        $category->update($updateCategoryCommand->name);

        $this->categoryRepository->save($category);

        return CategoryDTO::fromEntity($category);
    }
}