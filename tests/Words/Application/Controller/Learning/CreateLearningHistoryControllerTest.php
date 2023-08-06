<?php

namespace App\Tests\Words\Application\Controller\Learning;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Entity\Category;
use App\Words\Domain\Entity\LearningStep;
use App\Words\Domain\Entity\Word;
use App\Words\Infrastructure\Repository\CategoryRepository;
use App\Words\Infrastructure\Repository\WordRepository;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class CreateLearningHistoryControllerTest extends AbstractControllerTest
{
    public function test_create_learning_history_success(): void
    {
        $user = $this->loadUserFixture();
        $category = $this->loadCategoryFixture();

        $word = new Word($category, 'apple', 'яблоко');
        $wordRepository = static::getContainer()->get(WordRepository::class);
        $wordRepository->add($word);

        $this->auth($user);

        $this->client->request(
            'POST',
            '/api/learning-histories',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'word_id' => $word->getId(),
                'step' => LearningStep::WRITE
            ])
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'required' => ['id', 'userId', 'word', 'learnedAt'],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }
}
