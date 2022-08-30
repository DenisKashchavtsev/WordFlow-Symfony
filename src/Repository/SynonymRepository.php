<?php

namespace App\Repository;

use App\Entity\Synonym;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Synonym>
 *
 * @method Synonym|null find($id, $lockMode = null, $lockVersion = null)
 * @method Synonym|null findOneBy(array $criteria, array $orderBy = null)
 * @method Synonym[]    findAll()
 * @method Synonym[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SynonymRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Synonym::class);
    }

    /**
     * @param Synonym $entity
     * @param bool $flush
     * @return void
     */
    public function add(Synonym $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Synonym $entity
     * @param bool $flush
     * @return void
     */
    public function remove(Synonym $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Synonym[] Returns an array of Synonym objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Synonym
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
