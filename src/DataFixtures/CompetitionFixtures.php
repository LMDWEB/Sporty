<?php

namespace App\DataFixtures;

use App\Entity\Competition;
use App\Entity\Confederation;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CompetitionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $baseUrl = "https://raw.githubusercontent.com/LMDWEB/Sporty/master/public/json/";
        $link = $baseUrl . "competition.json";
        $competitions = json_decode(file_get_contents($link));

        foreach ($competitions as $competition) {

            $team = $manager->getRepository(Team::class)->findOneBy(['name' => $competition->section]);
            $conf = $manager->getRepository(Confederation::class)->findOneBy(['name' => $competition->conf]);

            $date = $faker->dateTime();
            $compet = (new Competition())
                ->setName($competition->name)
                ->setFormat($competition->format)
                ->setDivision($competition->division)
                ->setTypeClub($competition->type)
                ->setSection($team)
                ->setConfederation($conf)
                ->setCreatedAt($date)
                ->setUpdatedAt($date)
            ;

            $manager->persist($compet);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TeamFixtures::class,
            ConfederationFixtures::class
        ];
    }
}