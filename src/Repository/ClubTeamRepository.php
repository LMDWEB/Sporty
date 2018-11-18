<?php

namespace App\Repository;

use App\Entity\ClubTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClubTeams|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubTeams|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubTeams[]    findAll()
 * @method ClubTeams[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubTeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClubTeam::class);
    }

    // /**
    //  * @return ClubTeams[] Returns an array of ClubTeams objects
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
    public function findOneBySomeField($value): ?ClubTeams
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
