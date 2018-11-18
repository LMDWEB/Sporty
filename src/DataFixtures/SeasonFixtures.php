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
        for ($i = 1970; $i < 2020; $i++) {
            $beginYear = $i;
            $endYear = $i + 1;
            $season = (new Season())
                ->setSeasonYear($beginYear . '/' . $endYear)
                ->setCreatedAt($date)
                ->setUpdatedAt($date);

            $manager->persist($season);
        }

        $manager->flush();
    }
}