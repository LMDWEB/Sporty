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
        $link = "http://localhost:8000/json/competition.json";
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