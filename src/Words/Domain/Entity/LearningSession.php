<?php

namespace App\Words\Domain\Entity;

use App\Shared\Domain\Service\UlidService;
use DateTime;

class LearningSession
{
    private string $id;
    private DateTime $startedAt;
    private ?DateTime $endedAt;
    private array $words;

    private function __construct(private readonly string $userId, private readonly Category $category)
    {
        $this->id = UlidService::generate();
        $this->startedAt = new DateTime();
        $this->endedAt = null;
    }

    public static function start(string $userId, Category $category): self
    {
        return new self($userId, $category);
    }

    public function finish(): self
    {
        $this->endedAt = new DateTime();

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStartedAt(): DateTime
    {
        return $this->startedAt;
    }

    public function getEndedAt(): ?DateTime
    {
        return $this->endedAt;
    }

    public function getCategory(): Category
    {
        return $this->category;
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
}