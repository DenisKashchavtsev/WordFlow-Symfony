<?php

namespace App\Words\Domain\Aggregate;

use App\Shared\Domain\Aggregate\Aggregate;

class User extends Aggregate
{
    private array $categories = [];

    private string $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): User
    {
        $this->id = $id;

        return $this;
    }

    public function addCategoryForLearning(string $categoryId): User
    {
        $this->categories[] = $categoryId;

        return $this;
    }
}