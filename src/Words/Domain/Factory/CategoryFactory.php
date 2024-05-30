<?php

namespace App\Words\Domain\Factory;

use App\Words\Domain\Entity\Category;

class CategoryFactory
{
    public static function create(string $owner, string $name, string $image = '', bool $isPublic = false): Category
    {
        return Category::create($owner, $name, $image, $isPublic);
    }
}