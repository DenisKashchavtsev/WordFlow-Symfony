<?php

namespace App\Words\Application\UseCase\Command\Category\UpdateCategory;

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
        $categoryDTO = $updateCategoryCommand->categoryDTO;

        $category = $this->categoryRepository->find($categoryDTO->id);

        if (!$category) {
            throw new Exception('Category not found');
        }

        $category->update(
            $categoryDTO->name,
            $categoryDTO->image,
            $categoryDTO->isPublic);

        $this->categoryRepository->save($category);

        return CategoryDTO::fromEntity($category);
    }
}