<?php

namespace App\Words\Application\UseCase\Query\Category\GetCategories;

use App\Shared\Application\Query\QueryInterface;

class GetCategoriesQuery implements QueryInterface
{
    public function __construct(public string $page, public string $ownerId)
    {
    }
}