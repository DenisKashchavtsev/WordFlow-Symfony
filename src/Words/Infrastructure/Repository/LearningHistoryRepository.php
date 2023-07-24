<?php

namespace App\Words\Infrastructure\Repository;

use App\Words\Domain\Entity\LearningHistory;
use App\Words\Domain\Repository\LearningHistoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LearningHistoryRepository extends ServiceEntityRepository implements LearningHistoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LearningHistory::class);
    }

    public function add(LearningHistory $learningHistory): void
    {
        $this->_em->persist($learningHistory);
        $this->_em->flush();
    }

    public function delete(LearningHistory $learningHistory): void
    {
        $this->_em->remove($learningHistory);
        $this->_em->flush();
    }
}