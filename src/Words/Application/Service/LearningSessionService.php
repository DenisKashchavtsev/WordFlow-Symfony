<?php

namespace App\Words\Application\Service;

use App\Words\Application\DTO\LearningSessionDTO;
use App\Words\Domain\Aggregate\LearningSession;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use App\Words\Domain\Repository\LearningSessionRepositoryInterface;
use App\Words\Domain\Repository\WordRepositoryInterface;

class LearningSessionService
{
    public function __construct(
        private readonly WordRepositoryInterface            $wordRepository,
        private readonly LearningSessionRepositoryInterface $learningRepository,
        private readonly CategoryRepositoryInterface        $categoryRepository)
    {
    }

    public function getSessionWithWords(string $userId, string $categoryId): LearningSessionDTO
    {
        $learningSession = $this->learningRepository->findBy(['userId' => $userId, 'category' => $categoryId]);

        if (!$learningSession) {
            $category = $this->categoryRepository->find($categoryId);

            $learningSession = LearningSession::start($userId, $category);
        }

        $words = $this->wordRepository->getWordsForLearning($categoryId);

        $learningSession->setWords($words);

        return LearningSessionDTO::fromEntity($learningSession);
    }
}