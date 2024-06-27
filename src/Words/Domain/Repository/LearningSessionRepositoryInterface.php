<?php

namespace App\Words\Domain\Repository;

use App\Words\Domain\Aggregate\Word;

interface LearningSessionRepositoryInterface
{
    public function add(Word $word): void;

    public function save(Word $word): void;

    public function delete(Word $word): void;

    public function getWordsByCategory(string $categoryId, int $page = 1, int $limit = 10): array;
}