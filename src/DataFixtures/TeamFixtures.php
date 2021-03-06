<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $baseUrl = "https://raw.githubusercontent.com/LMDWEB/Sporty/master/public/json";
        $teamArray = json_decode(file_get_contents($baseUrl . "/typeTeams.json"));
        $date = $faker->dateTime();

        foreach ($teamArray as  $team) {
            $teams = (new Team())
                ->setName($team->name)
                ->setSection($team->section)
                ->setCreatedAt($date)
                ->setUpdatedAt($date)
            ;

            $manager->persist($teams);
        }

        $manager->flush();
    }
}
