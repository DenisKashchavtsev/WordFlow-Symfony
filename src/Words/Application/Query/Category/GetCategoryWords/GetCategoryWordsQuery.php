<?php

namespace App\Words\Application\Query\Category\GetCategoryWords;

use App\Shared\Application\Query\QueryInterface;

class GetCategoryWordsQuery implements QueryInterface
{
    public function __construct(public string $categoryId, public string $page)
    {
    }
}