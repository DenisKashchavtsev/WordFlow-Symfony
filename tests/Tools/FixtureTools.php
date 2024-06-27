<?php

namespace App\Tests\Tools;

use App\Tests\Resource\Fixture\Users\UserFixture;
use App\Tests\Resource\Fixture\Words\CategoryFixture;
use App\Tests\Resource\Fixture\Words\WordFixture;
use App\Users\Domain\Aggregate\User;
use App\Words\Domain\Aggregate\Category;
use App\Words\Domain\Aggregate\Word;
use Doctrine\Common\DataFixtures\Executor\AbstractExecutor;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

trait FixtureTools
{
    private ?AbstractExecutor $executor = null;

    public function loadUserFixture(): User
    {
        /** @var User $user */
        $user = $this->getExecutor()->getReferenceRepository()->getReference(UserFixture::REFERENCE);

        return $user;
    }

    public function getExecutor(): AbstractExecutor
    {
        if (!$this->executor) {
            $this->executor = $this->getDatabaseTools()->loadAllFixtures();
        }
        return $this->executor;
    }

    public function getDatabaseTools(): AbstractDatabaseTool
    {
        return static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function loadCategoryFixture(): Category
    {
        /** @var Category $category */
        $category = $this->getExecutor()->getReferenceRepository()->getReference(CategoryFixture::REFERENCE);

        return $category;
    }

    public function loadWordFixture(): Word
    {
        /** @var Word $word */
        $word = $this->getExecutor()->getReferenceRepository()->getReference(WordFixture::REFERENCE);

        return $word;
    }
}