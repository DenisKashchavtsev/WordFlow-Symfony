<?php

namespace App\Words\Domain\Repository;

use App\Shared\Infrastructure\Symfony\Paginator;
use App\Words\Domain\Aggregate\Category;

interface CategoryRepositoryInterface
{
    public function add(Category $category): void;

    public function save(Category $category): void;

    public function delete(Category $category): void;

    public function findByUser(string $userId): Paginator;

    public function getPopular(): Paginator;

    public function findByName(string $name): Paginator;
}