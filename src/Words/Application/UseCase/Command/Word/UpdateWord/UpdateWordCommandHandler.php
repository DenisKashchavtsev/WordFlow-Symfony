<?php

namespace App\Words\Application\UseCase\Command\Word\UpdateWord;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Words\Application\DTO\WordDTO;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Exception;

class UpdateWordCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly WordRepositoryInterface $wordRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(UpdateWordCommand $updateWordCommand): WordDTO
    {
        $word = $this->wordRepository->find($updateWordCommand->id);

        if (!$word) {
            throw new Exception('Word not found');
        }

        $word->update($updateWordCommand->source, $updateWordCommand->translate);

        $this->wordRepository->save($word);

        return WordDTO::fromEntity($word);
    }
}