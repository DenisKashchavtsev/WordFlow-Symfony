<?php

namespace App\Words\Application\Query\Category\GetCategoryWords;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Infrastructure\Symfony\Paginator;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Exception;

class GetCategoryWordsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly WordRepositoryInterface $wordRepository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(GetCategoryWordsQuery $query): Paginator
    {
        return $this->wordRepository->getWordsByCategory($query->categoryId, $query->page);
    }
}