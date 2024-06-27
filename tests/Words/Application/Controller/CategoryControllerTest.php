<?php

namespace App\Tests\Words\Application\Controller;

use App\Tests\AbstractControllerTest;
use Symfony\Component\HttpFoundation\Response;

class CategoryControllerTest extends AbstractControllerTest
{
    public function test_list_categories_success(): void
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

        $this->assertEquals(json_decode($response, true),
            [
                'totalPages' => 1,
                'resultCount' => 1,
                'data' => [[
                    'id' => $category->getId(),
                    'name' => $category->getName(),
                    'image' => $category->getImage(),
                    'isPublic' => $category->getIsPublic(),
                ]]]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function test_show_category_success(): void
    {
        $user = $this->loadUserFixture();
        $category = $this->loadCategoryFixture();
        $this->auth($user);

        $this->client->request(
            'GET',
            '/api/word-categories/' . $category->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals(json_decode($response, true),
            [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'image' => $category->getImage(),
                'isPublic' => $category->getIsPublic(),
            ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function test_create_category_success(): void
    {
        $data = [
            'name' => $this->faker->title(),
            'image' => $this->faker->title(),
            'isPublic' => true,
        ];

        $this->auth();

        $this->client->request(
            'POST',
            '/api/word-categories',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data)
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatches(json_decode($response, true), $data);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }

    public function test_update_word_success(): void
    {
        $this->loadUserFixture();
        $category = $this->loadCategoryFixture();

        $data = [
            'id' => $category->getId(),
            'name' => 'Category #1 updated',
            'image' => 'image url updated',
            'isPublic' => true,
        ];

        $this->client->request(
            'PUT',
            '/api/word-categories',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data)
        );

        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatches(json_decode($response, true), $data);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

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

    public function test_delete_some_category_success(): void
    {
        $this->loadUserFixture();
        $category = $this->loadCategoryFixture();

        $this->client->request(
            'DELETE',
            '/api/word-categories',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['ids' => [
                $category->getId(),
            ]]),
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }

    public function test_show_category_words_success(): void
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

    public function test_list_popular_categories_success(): void
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

        $this->assertEquals(json_decode($response, true),
            [
                'totalPages' => 1,
                'resultCount' => 1,
                'data' => [[
                    'id' => $category->getId(),
                    'name' => $category->getName(),
                    'image' => $category->getImage(),
                    'isPublic' => $category->getIsPublic(),
                ]]]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
