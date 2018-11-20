<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClubFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $clubArray = array(
            array(
                "name" => "Paris Saint-Germain",
                "abbreviation" => "PSG",
                "image" => "psg.jpg",
                "nationality" => "FR"
            ),
            array(
                "name" => "AS Monaco",
                "abbreviation" => "ASM",
                "image" => "monaco.jpg",
                "nationality" => "FR"
            )
        );

        foreach ($clubArray as  $club) {
            $clubs = new Club();
            $clubs
                ->setName($club['name'])
                ->setAbbreviation($club['abbreviation'])
                ->setImage($club['image'])
                ->setCountry($club['nationality'])
            ;

            $manager->persist($clubs);
        }

        $manager->flush();
    }
}
