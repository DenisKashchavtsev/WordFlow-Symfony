<?php

namespace App\Tests\Users\Infrastructure\Repository;

use App\Tests\AbstractRepositoryTest;
use App\Tests\Resource\Fixture\Users\UserFixture;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Faker\Factory;
use Faker\Generator;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class UserRepositoryTest extends AbstractRepositoryTest
{
    private Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = static::getContainer()->get(UserRepository::class);
        $this->faker = Factory::create();
        $this->userFactory = static::getContainer()->get(UserFactory::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_user_added_successfully(): void
    {
        $email = $this->faker->email();
        $password = $this->faker->password();
        $user = $this->userFactory->create($email, $password);

        // act
        $this->repository->add($user);

        $existingUser = $this->repository->find($user->getId());
        $this->assertEquals($existingUser->getId(), $user->getId());
    }
//
//    public function test_user_found_successfully(): void
//    {
//        // arrange
//        $executor = $this->databaseTool->loadFixtures([UserFixture::class]);
//        /** @var User $user */
//        $user = $executor->getReferenceRepository()->getReference(UserFixture::REFERENCE);
//
//        // act
//        $existingUser = $this->repository->findByUlid($user->getId());
//
//        // assert
//        $this->assertEquals($user->getId(), $existingUser->getId());
//    }
}
