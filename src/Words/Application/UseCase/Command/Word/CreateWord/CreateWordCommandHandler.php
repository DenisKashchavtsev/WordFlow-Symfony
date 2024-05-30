<?php

namespace App\Words\Application\UseCase\Command\Word\CreateWord;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Words\Application\DTO\WordDTO;
use App\Words\Domain\Entity\Word;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Exception;

class CreateWordCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly WordRepositoryInterface     $wordRepository,
                                private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(CreateWordCommand $createWordCommand): WordDTO
    {
        $category = $this->categoryRepository->find($createWordCommand->categoryId);

        if (!$category) {
            throw new Exception('Category not found');
        }

        $word = new Word($category, $createWordCommand->source, $createWordCommand->translate);

        $this->wordRepository->add($word);

        return WordDTO::fromEntity($word);
    }
}