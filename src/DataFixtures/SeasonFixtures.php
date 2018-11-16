<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $date = $faker->dateTime();
        $team = (new Season())
            ->setName('2017- 2018')
            ->setCreatedAt($date)
            ->setUpdatedAt($date)
        ;

        $manager->persist($team);

        $manager->flush();
    }
}