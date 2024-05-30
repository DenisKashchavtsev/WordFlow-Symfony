<?php

namespace App\Words\Application\UseCase\Command\Category\CreateCategory;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Domain\Factory\CategoryFactory;
use App\Words\Domain\Repository\CategoryRepositoryInterface;

class CreateCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly CategoryFactory             $categoryFactory)
    {
    }

    public function __invoke(CreateCategoryCommand $createCategoryCommand): CategoryDTO
    {
        $categoryCreateDTO = $createCategoryCommand->categoryCreateDTO;

        $category = $this->categoryFactory::create(
            $createCategoryCommand->ownerId,
            $categoryCreateDTO->name,
            $categoryCreateDTO->image,
            $categoryCreateDTO->isPublic
        );

        $this->categoryRepository->add($category);

        return CategoryDTO::fromEntity($category);
    }
}