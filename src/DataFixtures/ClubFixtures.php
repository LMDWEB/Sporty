<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClubFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $baseUrl = "https://raw.githubusercontent.com/LMDWEB/Sporty/master/public/json";
        $clubArray = json_decode(file_get_contents($baseUrl . "/teamL1.json"));

        foreach ($clubArray as  $club) {
            $clubs = new Club();
            $clubs
                ->setName($club->team)
                ->setAbbreviation("")
                ->setImage("")
                ->setCountry($club->pays)
            ;

            $manager->persist($clubs);
        }

        $manager->flush();
    }
}
