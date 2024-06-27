<?php

namespace App\Tests\Words\Application\Controller\Learning;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Aggregate\LearningHistory;
use App\Words\Domain\Aggregate\LearningStep;
use App\Words\Domain\Aggregate\Word;
use App\Words\Infrastructure\Repository\LearningHistoryRepository;
use App\Words\Infrastructure\Repository\WordRepository;
use Symfony\Component\HttpFoundation\Response;

class LearnCategoryControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_learn_category_success(): void
    {
        $user = $this->loadUserFixture();
        $category = $this->loadCategoryFixture();

        $word = new Word($category, 'apple', 'яблоко');
        $wordRepository = static::getContainer()->get(WordRepository::class);
        $wordRepository->add($word);

        $learningHistory = new LearningHistory($user->getId(), $word, LearningStep::CHOOSE_CORRECT_OPTION);
        $learningHistoryRepository = static::getContainer()->get(LearningHistoryRepository::class);
        $learningHistoryRepository->add($learningHistory);

        $this->auth($user);

        $this->client->request(
            'GET',
            '/api/learn-category/' . $category->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'type' => 'object',
            'required' => ['id', 'category', 'words', 'startedAt', 'endedAt'],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
