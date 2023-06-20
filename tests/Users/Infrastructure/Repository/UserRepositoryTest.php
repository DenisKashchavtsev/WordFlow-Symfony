<?php

namespace App\Tests\Users\Infrastructure\Repository;

use App\Tests\AbstractRepositoryTest;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Faker\Factory;
use Faker\Generator;

class UserRepositoryTest extends AbstractRepositoryTest
{
    private Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = static::getContainer()->get(UserRepository::class);
        $this->faker = Factory::create();
    }

    public function test_user_added_successfully()
    {
        $email = $this->faker->email();
        $password = $this->faker->password();

        $user = (new UserFactory())->create($email, $password);

        $this->repository->add($user);

        $existingUser = $this->repository->find($user->getId());
        $this->assertEquals($existingUser->getId(), $user->getId());
    }
}
