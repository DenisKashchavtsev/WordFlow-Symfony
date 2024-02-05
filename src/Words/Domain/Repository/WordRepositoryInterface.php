<?php

namespace App\Words\Domain\Repository;

use App\Shared\Infrastructure\Symfony\Paginator;
use App\Words\Domain\Entity\Word;

interface WordRepositoryInterface
{
    public function add(Word $word): void;

    public function save(Word $word): void;

    public function delete(Word $word): void;

    public function getWordsByCategory(string $categoryId, int $page = 1, int $limit = 10): Paginator;

    public function getWordsForLearning(string $categoryId, int $limit = 10): array;

    public function findByIds(array $wordIds): array;
}