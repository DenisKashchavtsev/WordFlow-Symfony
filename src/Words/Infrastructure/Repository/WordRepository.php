<?php

namespace App\Words\Infrastructure\Repository;

use App\Shared\Infrastructure\Symfony\Paginator;
use App\Words\Domain\Entity\Category;
use App\Words\Domain\Entity\LearningHistory;
use App\Words\Domain\Entity\LearningStep;
use App\Words\Domain\Entity\Word;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class WordRepository extends ServiceEntityRepository implements WordRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Word::class);
    }

    /**
     * @throws \Exception
     */
    public function getWordsByCategory(string $categoryId, int $page = 1, int $limit = 25): Paginator
    {
        $query = $this->_em->createQueryBuilder()
            ->select('w')
            ->from(Word::class, 'w')
            ->join(Category::class, 'c')
            ->andWhere('c.id = :categoryId')
            ->setParameter('categoryId', $categoryId);

        return new Paginator($query, $page, $limit);
    }

    public function getWordsForLearning(string $categoryId, int $limit = 10): array
    {
        return $this->_em->createQueryBuilder()
            ->select('w')
            ->from(Word::class, 'w')
            ->join(Category::class, 'c')
            ->leftJoin(
                LearningHistory::class,
                'lh',
                'WITH',
                'w.id = lh.word AND lh.step = :finalStep'
            )
            ->andWhere('c.id = :categoryId')
            ->andWhere('lh.step is NULL')
            ->setParameter('categoryId', $categoryId)
            ->setParameter('finalStep', LearningStep::WRITE)
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