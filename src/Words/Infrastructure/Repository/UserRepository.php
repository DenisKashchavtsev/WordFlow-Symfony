<?php

namespace App\Words\Infrastructure\Repository;

use App\Words\Domain\Entity\Word;
use App\Words\Domain\Repository\WordRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements WordRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Word::class);
    }

    public function add(Word $word): void
    {
        $this->_em->persist($word);
        $this->_em->flush();
    }
}