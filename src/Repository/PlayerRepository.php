<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function footPlayer($foot)
    {
        if ($foot == 0) {
            $footPlayer = 'player.foot.right';
        } elseif($foot == 1) {
            $footPlayer = "player.foot.left";
        } elseif($foot == 1) {
            $footPlayer = "player.foot.both";
        }

        return $footPlayer;
    }

}
