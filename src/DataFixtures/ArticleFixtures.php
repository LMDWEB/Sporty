<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $tags = $manager->getRepository(Tag::class)->findAll();

        for ($i = 0; $i < 20; $i++) {
            $date = $faker->dateTime();
            $article = (new Article())
                ->setTitle($faker->firstName)
                ->setContent($faker->text())
                ->addTag($tags[array_rand($tags)])
                ->setCreatedAt($date)
                ->setUpdatedAt($date)
                ->setPublished($faker->boolean)
                ->setArchived($faker->boolean)
                ->setPosition($faker->numberBetween(0, 20))
            ;
            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TagFixtures::class
        ];
    }
}