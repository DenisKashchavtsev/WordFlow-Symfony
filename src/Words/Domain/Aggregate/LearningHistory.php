<?php

namespace App\Words\Domain\Aggregate;

use App\Shared\Domain\Service\UlidService;
use DateTime;

class LearningHistory
{
    private string $id;
    private DateTime $learnedAt;

    public function __construct(
        private readonly string       $userId,
        private readonly Word         $word,
        private readonly LearningStep $step)
    {
        $this->id = UlidService::generate();
        $this->learnedAt = new DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function getLearnedAt(): DateTime
    {
        return $this->learnedAt;
    }

    public function getStep(): LearningStep
    {
        return $this->step;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}