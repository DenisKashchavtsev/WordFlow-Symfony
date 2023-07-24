<?php

namespace App\Tests\Words\Application\Controller\Word;

use App\Shared\Domain\Service\UlidService;
use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Entity\Category;
use App\Words\Infrastructure\Repository\CategoryRepository;
use App\Words\Infrastructure\Repository\WordRepository;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class CreateWordControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_create_word_success(): void
    {
        $user = $this->loadUserFixture();

        $category = new Category($user->getId(), $this->faker->name());
        $categoryRepository = static::getContainer()->get(CategoryRepository::class);
        $categoryRepository->add($category);

        $this->client->request(
            'POST',
            '/api/words',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'categoryId' => $category->getId(),
                'source' => 'apple1',
                'translate' => 'яблоко2',
            ])
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'required' => ['id', 'source', 'translate'],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }
}
