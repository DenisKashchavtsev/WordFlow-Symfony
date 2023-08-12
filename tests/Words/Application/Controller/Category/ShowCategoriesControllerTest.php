<?php

namespace App\Tests\Words\Application\Controller\Category;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use Symfony\Component\HttpFoundation\Response;

class ShowCategoriesControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_show_categories_success(): void
    {
        $user = $this->loadUserFixture();
        $category = $this->loadCategoryFixture();

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
            'type' => 'object',
        ]);

        $this->assertEquals(json_decode($response, true),
            [
                'totalPages' => 1,
                'resultCount' => 1,
                'data' => [[
                    'id' => $category->getId(),
                    'name' => $category->getName(),
                    'userId' => $category->getUserId(),
                    'words' => [],
                    'image' => $category->getImage(),
                    'public' => $category->isPublic()
                ]]]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
