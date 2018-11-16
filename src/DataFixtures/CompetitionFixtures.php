<?php

namespace App\DataFixtures;

use App\Entity\Competition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CompetitionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $date = $faker->dateTime();
        $team = (new Competition())
            ->setName('Ligue 1')
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
        ;

        $manager->persist($team);

        $manager->flush();
    }
}