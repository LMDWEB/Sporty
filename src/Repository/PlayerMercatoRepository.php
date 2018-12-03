<?php

namespace App\Repository;

use App\Entity\PlayerMercato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PlayerMercato|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerMercato|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerMercato[]    findAll()
 * @method PlayerMercato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerMercatoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlayerMercato::class);
    }

    // /**
    //  * @return PlayerMercato[] Returns an array of PlayerMercato objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlayerMercato
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
