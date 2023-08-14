<?php

namespace Words\Application\Controller\Category;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use Symfony\Component\HttpFoundation\Response;

class GetCategoryWordsControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_show_categories_success(): void
    {
        $user = $this->loadUserFixture();
        $category = $this->loadCategoryFixture();
        $word = $this->loadWordFixture();

        $this->auth($user);

        $this->client->request(
            'GET',
            '/api/word-categories/' . $category->getId() . '/words',
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
                    'id' => $word->getId(),
                    'source' => $word->getSource(),
                    'translate' => $word->getTranslate(),
                ]]]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
