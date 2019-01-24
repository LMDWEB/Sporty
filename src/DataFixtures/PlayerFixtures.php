<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $joueurs = json_decode(file_get_contents("http://localhost:8000/json/playerl1.json"));

        $playerArray = array();

        foreach ($joueurs as $joueur) {

            $city = (isset($joueur->{'Place of Birth'})) ? $joueur->{'Place of Birth'} : "";
            $foot = (isset($joueur->Foot)) ? ($joueur->Foot == "right") ? 0 : 1 : 0;

            $fullname = explode(' ', $joueur->Name);
            $firstname = $fullname[0];

            $lastname = (isset($fullname[1])) ? $fullname[1] : "";
            $nationality = strtoupper(substr($joueur->Nationality[0], 0, 2));

            $dateBirth = $joueur->{'Date of Birth'};

            $playerArray[] = array(
                "firstname" => $firstname,
                "lastname" => $lastname,
                "surname" => "",
                "image" => "",
                "cityBirth" => $city,
                "dateBirth" => new \DateTime($dateBirth),
                "foot" => $foot,
                "nationality" => $nationality,
                "status" => 0
            );

        }

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
