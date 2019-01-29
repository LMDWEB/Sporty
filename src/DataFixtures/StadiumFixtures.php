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

        $baseUrl = "https://raw.githubusercontent.com/LMDWEB/Sporty/master/public/json";
        $stadiums = json_decode(file_get_contents($baseUrl . "/stadium.json"));
        $date = $faker->dateTime();

        foreach ($stadiums as  $stadium) {
            $stad = (new Stadium())
                ->setName($stadium->name)
                ->setCapacity($stadium->capacity)
                ->setCreatedAt($date)
                ->setUpdatedAt($date)
            ;

            $manager->persist($stad);
        }

        $manager->flush();
    }
}