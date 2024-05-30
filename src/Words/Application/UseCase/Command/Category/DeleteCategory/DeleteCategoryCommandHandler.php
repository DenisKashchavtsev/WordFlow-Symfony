<?php

namespace App\Words\Application\UseCase\Command\Category\DeleteCategory;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Words\Domain\Repository\CategoryRepositoryInterface;

class DeleteCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function __invoke(DeleteCategoryCommand $deleteCategoryCommand)
    {
        foreach ($deleteCategoryCommand->ids as $id) {
            $category = $this->categoryRepository->find($id);

            if ($category) {
                $this->categoryRepository->delete($category);
            }
        }

        return null;
    }
}