<?php

namespace App\Words\Application\UseCase\Query\Word\ShowWord;

use App\Shared\Application\Query\QueryInterface;

class ShowWordQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}