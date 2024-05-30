<?php

namespace App\Words\Application\UseCase\Command\CreateLearningHistory;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Infrastructure\Security\UserFetcher;
use App\Words\Application\DTO\LearningHistoryDTO;
use App\Words\Application\Service\LearningFindStepService;
use App\Words\Domain\Entity\LearningHistory;
use App\Words\Domain\Repository\LearningHistoryRepositoryInterface;
use App\Words\Domain\Repository\WordRepositoryInterface;

class CreateLearningHistoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly WordRepositoryInterface            $wordRepository,
        private readonly LearningFindStepService            $findStepService,
        private readonly LearningHistoryRepositoryInterface $historyRepository,
        private readonly UserFetcher                        $userFetcher)
    {
    }

    public function __invoke(CreateLearningHistoryCommand $historyCommand): array
    {
        $user = $this->userFetcher->getAuthUser();
        $words = $this->wordRepository->findByIds($historyCommand->wordIds);

        $step = $this->findStepService->byValue($historyCommand->step);

        $responseLearningHistories = [];
        foreach ($words as $word) {
            $learningHistory = new LearningHistory($user->getId(), $word, $step);

            $this->historyRepository->add($learningHistory);

            $responseLearningHistories[] = LearningHistoryDTO::fromEntity($learningHistory);
        }

        return $responseLearningHistories;
    }
}