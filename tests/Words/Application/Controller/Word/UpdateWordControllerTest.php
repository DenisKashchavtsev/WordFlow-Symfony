<?php

namespace App\Tests\Words\Application\Controller\Word;

use App\Shared\Domain\Service\UlidService;
use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Entity\Category;
use App\Words\Domain\Entity\Word;
use App\Words\Infrastructure\Repository\CategoryRepository;
use App\Words\Infrastructure\Repository\WordRepository;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class UpdateWordControllerTest extends AbstractControllerTest
{
    public function test_update_word_success(): void
    {
        $user = $this->loadUserFixture();

        $category = new Category($user->getId(), $this->faker->name());
        $categoryRepository = static::getContainer()->get(CategoryRepository::class);
        $categoryRepository->add($category);

        $word = new Word($category, 'apple', 'яблоко');
        $wordRepository = static::getContainer()->get(WordRepository::class);
        $wordRepository->add($word);

        $this->client->request(
            'PUT',
            '/api/words/' . $word->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'categoryId' => $category->getId(),
                'source' => 'apple_updated',
                'translate' => 'яблоко_updated',
            ])
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'required' => ['id', 'source', 'translate'],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
