<?php

namespace App\Words\Infrastructure\Repository;

use App\Words\Domain\Entity\Category;
use App\Words\Domain\Repository\CategoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function add(Category $category): void
    {
        $this->_em->persist($category);
        $this->_em->flush();
    }

    public function save(Category $category): void
    {
        $this->_em->persist($category);
        $this->_em->flush();
    }

    public function delete(Category $category): void
    {
        $this->_em->remove($category);
        $this->_em->flush();
    }

    public function findByUser(string $userId): array
    {
        return $this->findBy(['userId' => $userId]);
    }
}