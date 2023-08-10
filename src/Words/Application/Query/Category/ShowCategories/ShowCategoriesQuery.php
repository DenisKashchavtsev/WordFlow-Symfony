<?php

namespace App\Words\Application\Query\Category\ShowCategories;

use App\Shared\Application\Query\QueryInterface;

class ShowCategoriesQuery implements QueryInterface
{
    public function __construct(public string $page)
    {
    }
}