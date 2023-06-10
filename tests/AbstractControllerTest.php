<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Helmich\JsonAssert\JsonAssertions;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractControllerTest extends WebTestCase
{
    use JsonAssertions;

    protected AbstractDatabaseTool $databaseTool;
    protected KernelBrowser $client;
    protected ?EntityManagerInterface $em;
    protected string $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->em = self::getContainer()->get('doctrine.orm.entity_manager');
    }

    protected function auth(): void
    {

    }
}
