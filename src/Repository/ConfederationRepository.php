<?php

namespace App\Repository;

use App\Entity\Confederation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Confederation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Confederation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Confederation[]    findAll()
 * @method Confederation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfederationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Confederation::class);
    }

    // /**
    //  * @return Confederation[] Returns an array of Confederation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Confederation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
