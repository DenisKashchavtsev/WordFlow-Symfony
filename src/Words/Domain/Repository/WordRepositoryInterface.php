<?php

namespace App\Words\Domain\Repository;

use App\Words\Domain\Entity\Word;

interface WordRepositoryInterface
{
    public function add(Word $word): void;
}