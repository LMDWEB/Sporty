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

        $date = $faker->dateTime();
        $team = (new Team())
            ->setName('A')
            ->setSection(0)
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
        ;

        $manager->persist($team);

        $team = (new Team())
            ->setName('U19')
            ->setSection(0)
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
        ;

        $manager->persist($team);

        $team = (new Team())
            ->setName('A')
            ->setSection(1)
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
        ;

        $manager->persist($team);

        $manager->flush();
    }
}
