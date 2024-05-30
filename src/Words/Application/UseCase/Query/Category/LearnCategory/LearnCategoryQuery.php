<?php

namespace App\Words\Application\UseCase\Query\Category\LearnCategory;

use App\Shared\Application\Query\QueryInterface;

class LearnCategoryQuery implements QueryInterface
{
    public function __construct(public readonly string $categoryId)
    {
    }
}