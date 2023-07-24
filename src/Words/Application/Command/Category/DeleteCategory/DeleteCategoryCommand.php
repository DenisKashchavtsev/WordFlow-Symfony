<?php

namespace App\Words\Application\Command\Category\DeleteCategory;

use App\Shared\Application\Command\CommandInterface;

class DeleteCategoryCommand implements CommandInterface
{
    public function __construct(public readonly string $id)
    {
    }
}