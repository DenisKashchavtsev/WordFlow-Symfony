<?php

namespace App\Words\Application\Query\Word\ShowWord;

use App\Shared\Application\Query\QueryInterface;

class ShowWordQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}