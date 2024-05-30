<?php

namespace App\Words\Application\UseCase\Command\Word\DeleteWord;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Words\Domain\Repository\WordRepositoryInterface;

class DeleteWordCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly WordRepositoryInterface $wordRepository)
    {
    }

    public function __invoke(DeleteWordCommand $deleteWordCommand)
    {
        foreach ($deleteWordCommand->ids as $id) {
            $word = $this->wordRepository->find($id);

            if ($word) {
                $this->wordRepository->delete($word);
            }
        }

        return null;
    }
}