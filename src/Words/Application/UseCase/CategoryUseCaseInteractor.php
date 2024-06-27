<?php

namespace App\Words\Application\UseCase;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\Security\UserFetcher;
use App\Words\Application\DTO\CategoryCreateDTO;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Application\DTO\ListDTO;
use App\Words\Application\UseCase\Command\Category\CreateCategory\CreateCategoryCommand;
use App\Words\Application\UseCase\Command\Category\DeleteCategory\DeleteCategoryCommand;
use App\Words\Application\UseCase\Command\Category\UpdateCategory\UpdateCategoryCommand;
use App\Words\Application\UseCase\Query\Category\GetCategories\GetCategoriesQuery;
use App\Words\Application\UseCase\Query\Category\GetCategory\GetCategoryQuery;
use App\Words\Application\UseCase\Query\Category\GetCategoryWords\GetCategoryWordsQuery;

class CategoryUseCaseInteractor
{
    public function __construct(
        private readonly QueryBusInterface   $queryBus,
        private readonly CommandBusInterface $commandBus,
        private readonly UserFetcher         $userFetcher
    )
    {
    }

    public function getCategoriesByAuthUser(int $page = 1): ListDTO
    {
        $user = $this->userFetcher->getAuthUser();

        $query = new GetCategoriesQuery($page, $user->getId());

        return $this->queryBus->execute($query);
    }

    public function getCategory(string $id): CategoryDTO
    {
        $query = new GetCategoryQuery($id);

        return $this->queryBus->execute($query);
    }

    public function crateCategory(CategoryCreateDTO $categoryUpdateDTO)
    {
        $user = $this->userFetcher->getAuthUser();

        $command = new CreateCategoryCommand($categoryUpdateDTO, $user->getId());

        return $this->commandBus->execute($command);
    }

    public function updateCategory(CategoryDTO $categoryDTO)
    {
        $command = new UpdateCategoryCommand($categoryDTO);

        return $this->commandBus->execute($command);
    }

    public function deleteCategories(array $ids)
    {
        $command = new DeleteCategoryCommand($ids);

        return $this->commandBus->execute($command);
    }

    public function getCategoryWords(string $categoryId, int $page = 1)
    {
        $query = new GetCategoryWordsQuery($categoryId, $page);

        return $this->queryBus->execute($query);
    }
}