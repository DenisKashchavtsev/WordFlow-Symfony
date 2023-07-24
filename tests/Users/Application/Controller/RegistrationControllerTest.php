<?php

namespace App\Tests\Users\Application\Controller;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;
use Faker\Factory;

class RegistrationControllerTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_registration(): void
    {
        $this->faker = Factory::create();

        $this->client->request(
            'POST',
            '/api/auth/registration',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
                'email' => $this->faker->email(),
                'password' => $this->faker->password(),
            ])
        );
        $response = $this->client->getResponse()->getContent();

        $this->assertJsonDocumentMatchesSchema($response, [
            'required' => ['id', 'name', 'email'],
        ]);
    }
}