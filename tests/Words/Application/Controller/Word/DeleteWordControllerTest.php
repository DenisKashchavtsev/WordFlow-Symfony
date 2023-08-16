<?php

namespace App\Tests\Words\Application\Controller\Word;

use App\Tests\AbstractControllerTest;
use Symfony\Component\HttpFoundation\Response;

class DeleteWordControllerTest extends AbstractControllerTest
{
    public function test_delete_word_success(): void
    {
        $this->loadUserFixture();
        $this->loadCategoryFixture();
        $word = $this->loadWordFixture();

        $this->client->request(
            'DELETE',
            '/api/words/' . $word->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }

    public function test_delete_some_word_success(): void
    {
        $this->loadUserFixture();
        $this->loadCategoryFixture();
        $word = $this->loadWordFixture();

        $this->client->request(
            'DELETE',
            '/api/words',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['ids' => [
                $word->getId(),
            ]]),
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }
}
