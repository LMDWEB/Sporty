<?php

namespace App\Repository;

use App\Entity\PlayerMercato;
use App\Entity\Season;
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

    public function getSeason($date)
    {
        $month = $date->format("m");
        $year = $date->format("Y");

        $season = ($month < 7) ? ($year - 1) . "/" . $year : $year . "/" . ($year + 1);

        return $season;
    }

}
