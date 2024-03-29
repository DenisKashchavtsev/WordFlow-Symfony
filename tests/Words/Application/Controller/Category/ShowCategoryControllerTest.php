<?php

namespace App\Tests\Words\Application\Controller\Category;

use App\Shared\Domain\Service\UlidService;
use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use App\Words\Domain\Entity\Category;
use App\Words\Infrastructure\Repository\CategoryRepository;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class ShowCategoryControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_show_category_success(): void
    {
        $this->loadUserFixture();
        $category = $this->loadCategoryFixture();

        $this->client->request(
            'GET',
            '/api/word-categories/' . $category->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'required' => ['id', 'name'],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
