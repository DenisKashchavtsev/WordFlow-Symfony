<?php

namespace App\Words\Application\UseCase\Command\Category\DeleteCategory;

use App\Shared\Application\Command\CommandInterface;

class DeleteCategoryCommand implements CommandInterface
{
    public function __construct(public readonly array $ids)
    {
    }
}