<?php

namespace App\Words\Application\Query\Category\LearnCategory;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Infrastructure\Security\UserFetcher;
use App\Words\Application\DTO\LearningSessionDTO;
use App\Words\Application\Service\LearningSessionService;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use Exception;

class LearnCategoryQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly UserFetcher                 $userFetcher,
        private readonly LearningSessionService      $learningSessionService
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(LearnCategoryQuery $query): LearningSessionDTO
    {
        $category = $this->categoryRepository->find($query->categoryId);

        if (!$category) {
            throw new Exception('Category not found');
        }

        $user = $this->userFetcher->getAuthUser();

        return $this->learningSessionService->getSessionWithWords($user->getId(), $category->getId());
    }
}