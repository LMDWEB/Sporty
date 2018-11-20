<?php

namespace App\DataFixtures;

use App\Entity\Competition;
use App\Entity\Confederation;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CompetitionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $section = $manager->getRepository(Team::class)->findOneBy(['id' => 1]);
        $conf = $manager->getRepository(Confederation::class)->findOneBy(['id' => 1]);

        $date = $faker->dateTime();
        $team = (new Competition())
            ->setName('Ligue 1')
            ->setFormat(1)
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
            ->setSection($section)
            ->setConfederation($conf)
            ->setDivision(1)
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
            ->setTypeClub(0)
        ;

        $manager->persist($team);

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