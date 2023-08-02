<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Words;

use App\Tests\Resource\Fixture\Users\UserFixture;
use App\Tests\Tools\FakerTools;
use App\Words\Domain\Factory\CategoryFactory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends AbstractFixture implements DependentFixtureInterface
{
    use FakerTools;

    public const REFERENCE = 'words_category';

    public function load(ObjectManager $manager): void
    {
        $user = clone $this->getReference(UserFixture::REFERENCE);

        $name = $this->getFaker()->name();
        $image = $this->getFaker()->imageUrl();

        $category = CategoryFactory::create($user->getId(), $name, $image, true);

        $manager->persist($category);
        $manager->flush();

        $this->addReference(self::REFERENCE, $category);
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }
}