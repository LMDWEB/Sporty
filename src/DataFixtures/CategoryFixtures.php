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

        $link = "http://localhost:8000/json/category.json";
        $categories = json_decode(file_get_contents($link));

        foreach ($categories as $category) {
            $date = $faker->dateTime();
            $cat = (new Category())
                ->setName($category->name)
                ->setCreatedAt($date)
                ->setUpdatedAt($date)
            ;
            $manager->persist($cat);
        }

        $manager->flush();
    }
}