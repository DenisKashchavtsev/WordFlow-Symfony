<?php

namespace App\Words\Application\UseCase\Query\Word\ShowWord;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Words\Application\DTO\WordDTO;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Exception;

class ShowWordQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly WordRepositoryInterface $wordRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(ShowWordQuery $query): WordDTO
    {
        $word = $this->wordRepository->find($query->id);

        if (!$word) {
            throw new Exception('Word not found');
        }

        return WordDTO::fromEntity($word);
    }
}