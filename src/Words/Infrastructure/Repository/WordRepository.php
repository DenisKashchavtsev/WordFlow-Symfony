<?php

namespace App\Words\Infrastructure\Repository;

use App\Shared\Infrastructure\Symfony\Paginator;
use App\Words\Domain\Entity\Category;
use App\Words\Domain\Entity\LearningHistory;
use App\Words\Domain\Entity\LearningStep;
use App\Words\Domain\Entity\Word;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ArrayParameterType;
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
            ->where('w.category = :categoryId')
            ->setParameter('categoryId', $categoryId);

        return new Paginator($query, $page, $limit);
    }

    public function getWordsForLearning(string $categoryId, int $limit = 3): array
    {
        return $this->_em->createQueryBuilder()
            ->select('w.id, w.source, w.translate')
            ->addSelect('(SELECT MAX(wlh.step) FROM ' . LearningHistory::class . ' wlh WHERE w.id = wlh.word) AS currentStep')
            ->from(Word::class, 'w')
            ->join(Category::class, 'c')
            ->leftJoin(
                LearningHistory::class,
                'lh',
                'WITH',
                'w.id = lh.word'
            )
            ->andWhere('c.id = :categoryId')
            ->andWhere('lh.step < :maxStep OR lh.step IS NULL')
            ->andHaving('currentStep < :maxStep OR currentStep IS NULL')
            ->setParameter('categoryId', $categoryId)
            ->setParameter('maxStep', LearningStep::WRITE)
            ->setMaxResults($limit)
            ->distinct('w.id')
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

    public function findByIds(array $wordIds): array
    {
        return $this->_em->createQuery("SELECT w FROM " . Word::class . " w WHERE w.id IN (:ids)")
            ->setParameter('ids', $wordIds, ArrayParameterType::STRING)
            ->getResult();
    }
}