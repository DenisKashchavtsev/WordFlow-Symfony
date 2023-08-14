<?php

namespace App\Words\Application\DTO;

use App\Words\Domain\Entity\Category;

class CategoryDTO
{
    public function __construct(public readonly string $id, public readonly string $name)
    {
    }

    public static function fromEntity(Category $category): CategoryDTO
    {
        return new self($category->getId(), $category->getName());
    }

}