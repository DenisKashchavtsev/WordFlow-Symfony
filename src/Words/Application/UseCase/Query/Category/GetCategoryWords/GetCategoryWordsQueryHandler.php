<?php

namespace App\Words\Application\UseCase\Query\Category\GetCategoryWords;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Infrastructure\Symfony\Paginator;
use App\Words\Application\DTO\CategoryDTO;
use App\Words\Application\DTO\ListDTO;
use App\Words\Application\DTO\WordDTO;
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
    public function __invoke(GetCategoryWordsQuery $query): ListDTO
    {
        $paginator = $this->wordRepository->getWordsByCategory($query->categoryId, $query->page);

        $categories = array_map(fn($entity) => WordDTO::fromEntity($entity), $paginator->getData());

        return new ListDTO($categories, $paginator->getResultCount(), $paginator->getTotalPages());
    }
}