<?php

namespace App\Words\Application\Command\CreateWord;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Words\Domain\Entity\Word;
use App\Words\Domain\Repository\WordRepositoryInterface;

class CreateWordCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly WordRepositoryInterface $wordRepository)
    {
    }

    public function __invoke(CreateWordCommand $createWordCommand): Word
    {
        $word = new Word($createWordCommand->source, $createWordCommand->translate);

        $this->wordRepository->add($word);

        return $word;
    }
}