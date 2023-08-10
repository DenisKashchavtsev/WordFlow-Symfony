<?php

namespace App\Words\Application\Query\Category\ShowCategories;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Infrastructure\Security\UserFetcher;
use App\Shared\Infrastructure\Symfony\Paginator;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use Exception;

class ShowCategoriesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly UserFetcher                 $userFetcher
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(ShowCategoriesQuery $query): Paginator
    {
        $user = $this->userFetcher->getAuthUser();

        return $this->categoryRepository->findByUser($user->getId(), $query->page);
    }
}