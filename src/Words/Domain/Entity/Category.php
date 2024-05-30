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
    private array $userIds = [];

    public function __construct(
        private readonly string $ownerId,
        private string          $name,
        private ?string         $image,
        private bool            $isPublic = false,
    )
    {
        $this->id = UlidService::generate();
    }

    public static function create(string $ownerId, string $name, string $image, bool $isPublic): self
    {
        $wordCategory = new self($ownerId, $name, $image, $isPublic);

        $wordCategory->raiseEvent(new CategoryCreatedEvent($wordCategory->id));

        return $wordCategory;
    }

    public function update(string $name, string $image, bool $isPublic): self
    {
        $this->name = $name;
        $this->image = $image;
        $this->isPublic = $isPublic;

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

    public function getOwnerId(): string
    {
        return $this->ownerId;
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

    public function getIsPublic(): bool
    {
        return $this->isPublic;
    }
}