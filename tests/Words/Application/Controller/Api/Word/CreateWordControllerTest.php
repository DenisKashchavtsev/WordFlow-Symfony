<?php

namespace App\Tests\Words\Application\Controller\Api\Word;

use App\Tests\AbstractControllerTest;

class CreateWordControllerTest extends AbstractControllerTest
{
    public function test_create_word_success(): void
    {
        $this->client->request(
            'POST',
            '/api/words',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'source' => 'apple1',
                'translate' => 'яблоко2',
            ])
        );

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertJsonDocumentMatchesSchema($response, ['id']);
        $this->assertResponseStatusCodeSame(201);
    }
}
