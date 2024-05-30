<?php

namespace App\Words\Application\DTO;

use App\Shared\Application\Validator\NotBlank;
use App\Words\Domain\Entity\Category;

class CategoryDTO
{
    #[NotBlank]
    public string $id;

    #[NotBlank]
    public string $name;

    #[NotBlank]
    public string $image;

    public bool $isPublic = false;

    public static function fromEntity(Category $category): CategoryDTO
    {
        $categoryDTO = new self();

        $categoryDTO->id = $category->getId();
        $categoryDTO->name = $category->getName();
        $categoryDTO->image = $category->getImage();
        $categoryDTO->isPublic = $category->getIsPublic();

        return $categoryDTO;
    }
}