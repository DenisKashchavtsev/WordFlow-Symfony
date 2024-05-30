<?php

namespace App\Words\Application\DTO;

class ListDTO
{
    public function __construct(public array $data = [], public int $resultCount = 1, public int $totalPages = 1)
    {
    }
}