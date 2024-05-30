<?php

namespace App\Words\Application\UseCase\Command\Category\CreateCategory;

use App\Shared\Application\Command\CommandInterface;
use App\Words\Application\DTO\CategoryCreateDTO;

class CreateCategoryCommand implements CommandInterface
{
    public function __construct(public readonly CategoryCreateDTO $categoryCreateDTO, public string $ownerId)
    {
    }
}