<?php

namespace App\Words\Domain\Entity;

use App\Shared\Domain\Entity\Aggregate;
use App\Shared\Domain\Service\UlidService;
use App\Words\Domain\Event\Word\WordCreatedEvent;
use App\Words\Domain\Event\Word\WordUpdatedEvent;

class Word extends Aggregate
{
    private string $id;

    public function __construct(
        private readonly Category $category,
        private string            $source,
        private string            $translate)
    {
        $this->id = UlidService::generate();
    }

    public function create(Category $category, string $source, string $translate): self
    {
        $word = new self($category, $source, $translate);
        $word->raiseEvent(new WordCreatedEvent($word->id));

        return $word;
    }

    public function update(string $source, string $translate): self
    {
        $this->source = $source;
        $this->translate = $translate;

        $this->raiseEvent(new WordUpdatedEvent($this->id));

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getTranslate(): string
    {
        return $this->translate;
    }
}