<?php

namespace App\DataFixtures;

use App\Entity\Stadium;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class StadiumFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $date = $faker->dateTime();
        $team = (new Stadium())
            ->setName('Alianz Arena')
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
        ;

        $manager->persist($team);

        $manager->flush();
    }
}