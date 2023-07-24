<?php

namespace App\Tests\Words\Application\Controller\Category;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Entity\Category;
use App\Words\Infrastructure\Repository\CategoryRepository;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class ShowCategoriesControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_show_categories_success(): void
    {
        $user = $this->loadUserFixture();

        $category = new Category($user->getId(), $this->faker->name());
        $categoryRepository = static::getContainer()->get(CategoryRepository::class);
        $categoryRepository->add($category);

        $this->auth($user);

        $this->client->request(
            'GET',
            '/api/word-categories',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'type' => 'array',
        ]);

        $this->assertEquals($response,  '[{"id":"' . $category->getId() . '","name":"' . $category->getName() . '","userId":"' . $category->getUserId() . '","words":[]}]');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
