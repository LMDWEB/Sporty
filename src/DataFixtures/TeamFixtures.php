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
            ->setName('Equipe A')
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
        ;

        $manager->persist($team);

        $manager->flush();
    }
}
