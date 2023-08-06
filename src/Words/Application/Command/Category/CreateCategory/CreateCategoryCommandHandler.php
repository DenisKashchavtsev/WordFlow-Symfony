<?php

namespace App\Words\Application\Command\Category\CreateCategory;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Infrastructure\Security\UserFetcher;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Domain\Factory\CategoryFactory;
use App\Words\Domain\Repository\CategoryRepositoryInterface;

class CreateCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly UserFetcher                 $userFetcher,
        private readonly CategoryFactory             $categoryFactory)
    {
    }

    public function __invoke(CreateCategoryCommand $createCategoryCommand): CategoryDTO
    {
        $user = $this->userFetcher->getAuthUser();

        $category = $this->categoryFactory::create($user->getId(), $createCategoryCommand->name);

        $this->categoryRepository->add($category);

        return CategoryDTO::fromEntity($category);
    }
}