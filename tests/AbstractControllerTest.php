<?php

namespace App\Tests;

use App\Tests\Tools\FixtureTools;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Helmich\JsonAssert\JsonAssertions;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

abstract class AbstractControllerTest extends WebTestCase
{
    use JsonAssertions;
    use FixtureTools;

    protected KernelBrowser $client;
    protected ?EntityManagerInterface $em;
    protected string $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->client = static::createClient();
        $this->em = self::getContainer()->get('doctrine.orm.entity_manager');
    }

    protected function auth($user = null): void
    {
        if (!$user) {
            $user = $this->loadUserFixture();
        }

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
    }
}
