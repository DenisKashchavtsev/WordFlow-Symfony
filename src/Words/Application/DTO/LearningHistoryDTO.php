<?php

namespace App\Words\Application\DTO;

use App\Words\Domain\Aggregate\LearningHistory;
use DateTime;

class LearningHistoryDTO
{
    public function __construct(
        public readonly string    $id,
        public readonly string    $userId,
        public readonly array     $word,
        public readonly DateTime $learnedAt)
    {
    }

    public static function fromEntity(LearningHistory $session): LearningHistoryDTO
    {
        return new self(
            $session->getId(),
            $session->getUserId(),
            [
                'id' => $session->getWord()->getId(),
                'source' => $session->getWord()->getSource(),
                'translate' => $session->getWord()->getTranslate()
            ],
            $session->getLearnedAt()
        );
    }
}