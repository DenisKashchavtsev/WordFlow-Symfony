<?php

namespace App\Tests\Words\Application\Controller\Category;

use App\Tests\AbstractControllerTest;
use Symfony\Component\HttpFoundation\Response;

class CreateCategoryControllerTest extends AbstractControllerTest
{
    public function test_create_category_success(): void
    {
        $this->auth();

        $this->client->request(
            'POST',
            '/api/word-categories',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'name' => $this->faker->name(),
            ])
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'required' => ['id', 'name'],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }
}
