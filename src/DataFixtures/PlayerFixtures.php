<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $playerArray = array(
            array(
                "firstname" => "Clément",
                "lastname" => "Turpin",
                "surname" => "turp",
                "image" => "turpin.jpg",
                "cityBirth" => "ville",
                "dateBirth" => new \DateTime("1978-12-20"),
                "foot" => 0,
                "nationality" => "FR",
                "status" => 1
            ),
            array(
                "firstname" => "Kylian",
                "lastname" => "Mbappé",
                "surname" => "Kyky",
                "image" => "mbappe.jpg",
                "cityBirth" => "Bondy",
                "dateBirth" => new \DateTime("1998-12-20"),
                "foot" => 0,
                "nationality" => "FR",
                "status" => 0
            )
        );

        foreach ($playerArray as  $player) {
            $players = new Player();
            $players
                ->setFirstname($player["firstname"])
                ->setLastname($player["lastname"])
                ->setSurname($player["surname"])
                ->setImage($player["image"])
                ->setCityBirth($player["cityBirth"])
                ->setDateBirth($player["dateBirth"])
                ->setFoot($player["foot"])
                ->setNationality($player["nationality"])
                ->setStatus($player["status"])
            ;

            $manager->persist($players);
        }

        $manager->flush();
    }
}
