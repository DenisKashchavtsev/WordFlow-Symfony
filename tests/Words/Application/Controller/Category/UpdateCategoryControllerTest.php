<?php

namespace App\Tests\Words\Application\Controller\Category;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use Symfony\Component\HttpFoundation\Response;

class UpdateCategoryControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_update_word_success(): void
    {
        $this->loadUserFixture();
        $category = $this->loadCategoryFixture();

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
