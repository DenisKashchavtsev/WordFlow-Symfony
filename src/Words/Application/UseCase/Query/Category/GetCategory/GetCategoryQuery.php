<?php

namespace App\Words\Application\UseCase\Query\Category\GetCategory;

use App\Shared\Application\Query\QueryInterface;

class GetCategoryQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}