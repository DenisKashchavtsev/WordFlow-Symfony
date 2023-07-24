<?php

namespace App\Tests\Shared\Infrastructure\Controller;

use App\Tests\AbstractControllerTest;
use Symfony\Component\HttpFoundation\Response;

class TestAppControllerTest extends AbstractControllerTest
{
    public function testTestApp(): void
    {
        $this->client->request('get', '/test-app');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertJson(json_encode(['status' => 'ok']));
    }
}
