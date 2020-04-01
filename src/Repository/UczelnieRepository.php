<?php

namespace App\Repository;

use App\Entity\Uczelnie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Uczelnie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uczelnie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uczelnie[]    findAll()
 * @method Uczelnie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UczelnieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uczelnie::class);
    }

    // /**
    //  * @return Uczelnie[] Returns an array of Uczelnie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Uczelnie
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
