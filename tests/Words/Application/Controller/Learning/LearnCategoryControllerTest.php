<?php

namespace App\Tests\Words\Application\Controller\Learning;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Entity\Category;
use App\Words\Domain\Entity\Word;
use App\Words\Infrastructure\Repository\CategoryRepository;
use App\Words\Infrastructure\Repository\WordRepository;
use Faker\Factory;
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
