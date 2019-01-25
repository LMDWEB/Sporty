<?php

namespace App\Repository;

use App\Entity\Configuration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Configuration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Configuration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Configuration[]    findAll()
 * @method Configuration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Configuration::class);
    }


    public function config($data) {
        $qb = $this->createQueryBuilder('p')
            ->where('p.nameConfig = :nameConfig')
            ->setParameter('nameConfig', $data)
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->getQuery();

        $config = $qb->execute();

        return $config[0]->getValueConfig();
    }
}
