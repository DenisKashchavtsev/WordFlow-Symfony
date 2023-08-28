<?php

namespace Words\Application\Controller\Word;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use Symfony\Component\HttpFoundation\Response;

class ShowCategoryControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_show_word_success(): void
    {
        $this->loadUserFixture();
        $this->loadCategoryFixture();
        $word = $this->loadWordFixture();

        $this->client->request(
            'GET',
            '/api/word-words/' . $word->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'required' => ['id', 'source', 'translate'],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
