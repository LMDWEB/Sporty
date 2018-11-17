<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $team = new Team();
        $team
            ->setName('Equipe Première')
        ;

        $manager->persist($team);

        $manager->flush();
    }
}
