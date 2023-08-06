<?php

namespace App\Words\Domain\Entity;

use App\Shared\Domain\Entity\Aggregate;
use App\Shared\Domain\Service\UlidService;
use App\Words\Domain\Event\Category\CategoryCreatedEvent;
use App\Words\Domain\Event\Category\CategoryUpdatedEvent;

class Category extends Aggregate
{
    private string $id;
    private array $words = [];

    public function __construct(
        private readonly string  $userId,
        private string           $name,
        private readonly ?string $image,
        private readonly bool    $isPublic = false
    )
    {
        $this->id = UlidService::generate();
    }

    public static function create(string $userId, string $name, string $image, bool $isPublic): self
    {
        $wordCategory = new self($userId, $name, $image, $isPublic);

        $wordCategory->raiseEvent(new CategoryCreatedEvent($wordCategory->id));

        return $wordCategory;
    }

    public function update(string $name): self
    {
        $this->name = $name;

        $this->raiseEvent(new CategoryUpdatedEvent($this->id));

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getWords(): array
    {
        return $this->words;
    }

    public function setWords(array $words): void
    {
        $this->words = $words;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }
}