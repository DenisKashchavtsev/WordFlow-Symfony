<?php

namespace App\Words\Application\DTO;

use App\Words\Domain\Aggregate\LearningSession;
use DateTime;

class LearningSessionDTO
{
    public function __construct(
        public readonly string    $id,
        public readonly array     $category,
        public readonly string    $userId,
        public readonly array     $words,
        public readonly DateTime  $startedAt,
        public readonly ?DateTime $endedAt)
    {
    }

    public static function fromEntity(LearningSession $session): LearningSessionDTO
    {
        return new self(
            $session->getId(),
            [
                'id' => $session->getCategory()->getId(),
                'name' => $session->getCategory()->getName()
            ],
            $session->getUserId(),
            $session->getWords(),
            $session->getStartedAt(),
            $session->getEndedAt()
        );
    }

}