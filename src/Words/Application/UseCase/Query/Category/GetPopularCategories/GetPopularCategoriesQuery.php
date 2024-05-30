<?php

namespace App\Words\Application\UseCase\Query\Category\GetPopularCategories;

use App\Shared\Application\Query\QueryInterface;

class GetPopularCategoriesQuery implements QueryInterface
{
    public function __construct(public string $page)
    {
    }
}