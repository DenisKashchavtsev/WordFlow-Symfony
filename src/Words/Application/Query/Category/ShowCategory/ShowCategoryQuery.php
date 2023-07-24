<?php

namespace App\Words\Application\Query\Category\ShowCategory;

use App\Shared\Application\Query\QueryInterface;

class ShowCategoryQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}