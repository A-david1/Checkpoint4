<?php

namespace App\Repository;

use App\Entity\ReadingList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReadingList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReadingList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReadingList[]    findAll()
 * @method ReadingList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReadingListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReadingList::class);
    }

    // /**
    //  * @return ReadingList[] Returns an array of ReadingList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReadingList
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
