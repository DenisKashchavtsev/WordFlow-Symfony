<?php

namespace App\Tests\Users\Infrastructure\Controller;

use App\Tests\AbstractControllerTest;
use App\Tests\Tools\FixtureTools;

class GetMeActionTest extends AbstractControllerTest
{
    use FixtureTools;

    public function test_get_me_action(): void
    {
        $user = $this->loadUserFixture();

        $this->client->request(
            'POST',
            '/api/auth/token/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
            ])
        );
        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->client->setServerParameter('HTTP_AUTHORIZATION', sprintf('Bearer %s', $data['token']));

        // act
        $this->client->request('GET', '/api/users/me');

        // assert
        $data = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals($user->getEmail(), $data['email']);
    }
}