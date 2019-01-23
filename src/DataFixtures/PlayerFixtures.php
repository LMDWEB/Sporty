<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $joueurs = json_decode(file_get_contents("https://kidoo.ovh/api-foot/ligue1.json"));

        $playerArray = array();

        foreach ($joueurs as $joueur){

            if (isset($joueur->{'Place of Birth'})){
                $city = $joueur->{'Place of Birth'};
            } else {
                $city = "";
            }

            if (isset($joueur->Foot)){
                if ($joueur->Foot == "right"){
                    $foot = 0;
                } else {
                    $foot = 1;
                }
            } else {
                $foot = 0;
            }

            $fullname = explode(' ', $joueur->Name);
            $firstname = $fullname[0];
            if (isset($fullname[1])){
                $lastname = $fullname[1];
            } else {
                $lastname = "";
            }
            $nationality = strtoupper(substr($joueur->Nationality[0], 0, 2));



            $playerArray[] = array(
                "firstname" => $firstname,
                "lastname" => $lastname,
                "surname" => "",
                "image" => "",
                "cityBirth" => $city,
                "dateBirth" => new \DateTime("1978-12-20"),
                "foot" => $foot,
                "nationality" => $nationality,
                "status" => 1
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
