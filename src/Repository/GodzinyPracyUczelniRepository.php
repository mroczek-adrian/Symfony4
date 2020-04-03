<?php

namespace App\Repository;

use App\Entity\GodzinyPracyUczelni;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GodzinyPracyUczelni|null find($id, $lockMode = null, $lockVersion = null)
 * @method GodzinyPracyUczelni|null findOneBy(array $criteria, array $orderBy = null)
 * @method GodzinyPracyUczelni[]    findAll()
 * @method GodzinyPracyUczelni[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GodzinyPracyUczelniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GodzinyPracyUczelni::class);
    }

    // /**
    //  * @return GodzinyPracyUczelni[] Returns an array of GodzinyPracyUczelni objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GodzinyPracyUczelni
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
