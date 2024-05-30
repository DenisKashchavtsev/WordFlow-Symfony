<?php

namespace App\Words\Application\UseCase\Command\Word\DeleteWord;

use App\Shared\Application\Command\CommandInterface;

class DeleteWordCommand implements CommandInterface
{
    public function __construct(public readonly array $ids)
    {
    }
}