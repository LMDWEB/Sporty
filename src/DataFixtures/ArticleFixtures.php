<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $date = $faker->dateTime();
            $article = (new Article())
                ->setTitle($faker->text(50))
                ->setResume($faker->realText())
                ->setNamePhoto($faker->image())
                ->setContent($faker->text())
                ->setDate($faker->dateTime())
                ->setCreatedAt($date)
                ->setUpdatedAt($date)
                ->setType($faker->boolean)
                ->setFeatured($faker->boolean)
                ->setPublished($faker->boolean)
                ->setArchived($faker->boolean)
            ;
            $manager->persist($article);
        }

        $manager->flush();
    }
}