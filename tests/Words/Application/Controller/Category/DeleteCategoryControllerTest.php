<?php

namespace App\Tests\Words\Application\Controller\Category;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Entity\Category;
use App\Words\Infrastructure\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;

class DeleteCategoryControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_delete_category_success(): void
    {
        $user = $this->loadUserFixture();
        $category = new Category($user->getId(), $this->faker->name());

        $categoryRepository = static::getContainer()->get(CategoryRepository::class);
        $categoryRepository->add($category);

        $this->client->request(
            'DELETE',
            '/api/word-categories/' . $category->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }
}
