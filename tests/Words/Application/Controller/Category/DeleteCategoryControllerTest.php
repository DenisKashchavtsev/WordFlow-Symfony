<?php

namespace App\Tests\Words\Application\Controller\Category;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use Symfony\Component\HttpFoundation\Response;

class DeleteCategoryControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_delete_category_success(): void
    {
        $this->loadUserFixture();
        $category = $this->loadCategoryFixture();

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
