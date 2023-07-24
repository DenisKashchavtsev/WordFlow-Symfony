<?php

namespace App\Words\Application\Command\Category\CreateCategory;

use App\Shared\Application\Command\CommandInterface;

class CreateCategoryCommand implements CommandInterface
{
    public function __construct(public readonly string $name)
    {
    }
}