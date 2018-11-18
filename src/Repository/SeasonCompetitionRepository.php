<?php

namespace App\Repository;

use App\Entity\SeasonCompetition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SeasonCompetition|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeasonCompetition|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeasonCompetition[]    findAll()
 * @method SeasonCompetition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeasonCompetitionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SeasonCompetition::class);
    }

    // /**
    //  * @return SeasonCompetition[] Returns an array of SeasonCompetition objects
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
    public function findOneBySomeField($value): ?SeasonCompetition
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
