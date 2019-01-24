<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClubFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $clubArray = json_decode(file_get_contents("http://localhost:8000/json/teaml1.json"));

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
