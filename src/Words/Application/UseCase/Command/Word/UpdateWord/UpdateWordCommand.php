<?php

namespace App\Words\Application\UseCase\Command\Word\UpdateWord;

use App\Shared\Application\Command\CommandInterface;

class UpdateWordCommand implements CommandInterface
{
    public function __construct(
        public readonly string $id,
        public readonly string $source,
        public readonly string $translate)
    {
    }
}