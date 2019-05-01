<?php

namespace App\Repository;

use App\Entity\OrderGood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrderGood|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderGood|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderGood[]    findAll()
 * @method OrderGood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderGoodRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrderGood::class);
    }

    // /**
    //  * @return OrderGood[] Returns an array of OrderGood objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderGood
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
