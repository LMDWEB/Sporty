<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClubFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $club = new Club();
        $club
            ->setName('Paris Saint-Germain')
            ->setAbbreviation("PSG")
            ->setImage('psg.png')
            ->setCountry("FR")
        ;

        $manager->persist($club);

        $club
            ->setName('AS Monaco')
            ->setAbbreviation("ASM")
            ->setImage('asm.png')
            ->setCountry("FR")
        ;

        $manager->persist($club);

        $manager->flush();
    }
}
