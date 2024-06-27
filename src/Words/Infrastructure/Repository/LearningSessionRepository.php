<?php

namespace App\Words\Infrastructure\Repository;

use App\Words\Domain\Aggregate\Category;
use App\Words\Domain\Aggregate\LearningSession;
use App\Words\Domain\Aggregate\Word;
use App\Words\Domain\Repository\LearningRepositoryInterface;
use App\Words\Domain\Repository\LearningSessionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

class LearningSessionRepository extends ServiceEntityRepository implements LearningSessionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LearningSession::class);
    }

    /**
     * @throws Exception
     */
    public function getWordsByCategory(string $categoryId, int $page = 1, int $limit = 10): array
    {
        return $this->_em->createQueryBuilder()
            ->select('w')
            ->from(Word::class, 'w')
            ->join(Category::class, 'c')
            ->andWhere('c.id = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function add(Word $word): void
    {
        $this->_em->persist($word);
        $this->_em->flush();
    }

    public function save(Word $word): void
    {
        $this->_em->persist($word);
        $this->_em->flush();
    }

    public function delete(Word $word): void
    {
        $this->_em->remove($word);
        $this->_em->flush();
    }
}