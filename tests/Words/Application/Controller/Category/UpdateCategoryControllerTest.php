<?php

namespace App\Tests\Words\Application\Controller\Category;

use App\Shared\Domain\Service\UlidService;
use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Entity\Category;
use App\Words\Infrastructure\Repository\CategoryRepository;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class UpdateCategoryControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_update_word_success(): void
    {
        $user = $this->loadUserFixture();

        $category = new Category($user->getId(), $this->faker->name());
        $categoryRepository = static::getContainer()->get(CategoryRepository::class);
        $categoryRepository->add($category);

        $this->client->request(
            'PUT',
            '/api/word-categories/' . $category->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'name' => 'Category #1 updated',
            ])
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'required' => ['id', 'name'],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
