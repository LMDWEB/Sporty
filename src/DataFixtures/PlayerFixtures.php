<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $player = new Player();
        $date = new \DateTime("1998-12-20");
        $player
            ->setFirstname('Kylian')
            ->setLastname('Mbappé')
            ->setSurname('Mbappé')
            ->setDisplayName('Kylian Mbappé')
            ->setImage('mbappe.png')
            ->setCityBirth("Bondy")
            ->setDateBirth($date)
            ->setFoot(0)
            ->setNationality("FR")
            ->setStatus(0)
        ;
        $manager->persist($player);

        $manager->flush();
    }
}
