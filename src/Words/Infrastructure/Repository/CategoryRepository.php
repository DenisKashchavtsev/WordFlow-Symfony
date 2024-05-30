<?php

namespace App\Words\Infrastructure\Repository;

use App\Shared\Infrastructure\Symfony\Paginator;
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

    /**
     * @throws \Exception
     */
    public function findByUser(string $ownerId, int $page = 1, int $limit = 25): Paginator
    {
        $query = $this->_em->createQueryBuilder()
            ->select('c')
            ->from(Category::class, 'c')
            ->where('c.ownerId = :ownerId')
            ->setParameter('ownerId', $ownerId);

        return new Paginator($query, $page, $limit);
    }

    public function getPopular(): Paginator
    {
        // TODO: Implement getPopular() method.
    }

    public function findByName(string $name): Paginator
    {
        // TODO: Implement findByName() method.
    }
}