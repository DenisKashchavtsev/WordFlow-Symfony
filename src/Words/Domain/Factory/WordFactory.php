<?php

namespace App\Words\Domain\Factory;

use App\Words\Domain\Aggregate\Category;
use App\Words\Domain\Aggregate\Word;

class WordFactory
{
    public static function create(Category $category, string $source, string $translate): Word
    {
        return Word::create($category, $source, $translate);
    }
}