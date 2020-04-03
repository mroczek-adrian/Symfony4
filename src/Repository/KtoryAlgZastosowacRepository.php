<?php

namespace App\Repository;

use App\Entity\KtoryAlgZastosowac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method KtoryAlgZastosowac|null find($id, $lockMode = null, $lockVersion = null)
 * @method KtoryAlgZastosowac|null findOneBy(array $criteria, array $orderBy = null)
 * @method KtoryAlgZastosowac[]    findAll()
 * @method KtoryAlgZastosowac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KtoryAlgZastosowacRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KtoryAlgZastosowac::class);
    }

    // /**
    //  * @return KtoryAlgZastosowac[] Returns an array of KtoryAlgZastosowac objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KtoryAlgZastosowac
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
