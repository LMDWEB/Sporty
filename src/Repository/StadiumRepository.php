<?php

namespace App\Repository;

use App\Entity\Stadium;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stadium|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stadium|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stadium[]    findAll()
 * @method Stadium[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StadiumRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stadium::class);
    }

    // /**
    //  * @return Stadium[] Returns an array of Stadium objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stadium
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
