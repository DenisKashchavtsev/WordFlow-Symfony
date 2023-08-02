<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Words;

use App\Tests\Tools\FakerTools;
use App\Words\Domain\Factory\WordFactory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WordFixture extends AbstractFixture implements DependentFixtureInterface
{
    use FakerTools;

    public const REFERENCE = 'words_word';

    public function load(ObjectManager $manager): void
    {
        $category = clone $this->getReference(CategoryFixture::REFERENCE);
        $source = $this->getFaker()->word();
        $translate = $this->getFaker()->word();

        $word = WordFactory::create($category, $source, $translate);

        $manager->merge($word);
        $manager->flush();

        $this->addReference(self::REFERENCE, $word);
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixture::class,
        ];
    }
}