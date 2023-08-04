<?php

namespace App\Words\Domain\Factory;

use App\Words\Domain\Entity\Category;
use App\Words\Domain\Entity\Word;

class WordFactory
{
    public static function create(Category $category, string $source, string $translate): Word
    {
        return Word::create($category, $source, $translate);
    }
}