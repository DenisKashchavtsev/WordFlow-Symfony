<?php

namespace App\Words\Application\Command\Category\UpdateCategory;

use App\Shared\Application\Command\CommandInterface;

class UpdateCategoryCommand implements CommandInterface
{
    public function __construct(public readonly string $id, public readonly string $name)
    {
    }
}