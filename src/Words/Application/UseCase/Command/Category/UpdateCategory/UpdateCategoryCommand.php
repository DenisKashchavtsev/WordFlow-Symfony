<?php

namespace App\Words\Application\UseCase\Command\Category\UpdateCategory;

use App\Shared\Application\Command\CommandInterface;
use App\Words\Application\DTO\CategoryDTO;

class UpdateCategoryCommand implements CommandInterface
{
    public function __construct(public readonly CategoryDTO $categoryDTO)
    {
    }
}