<?php

namespace App\DataFixtures;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $date = $faker->dateTime();
            $article = (new Category())
                ->setName($faker->text(15))
                ->setCreatedAt($date)
                ->setUpdatedAt($date)
            ;
            $manager->persist($article);
        }

        $manager->flush();
    }
}