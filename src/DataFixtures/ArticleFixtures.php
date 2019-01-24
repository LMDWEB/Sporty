<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Player;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $cat = $manager->getRepository(Category::class)->findAll();
        $user =  $manager->getRepository(User::class)->findAll();
        $player =  $manager->getRepository(Player::class)->findAll();

        for ($i = 0; $i < 20; $i++) {
            $date = $faker->dateTime();
            $article = (new Article())
                ->setTitle($faker->text(50))
                ->setResume($faker->realText())
                ->setNamePhoto($faker->image())
                ->setContent($faker->text())
                ->setDate($faker->dateTime())
                ->setCategory($cat[array_rand($cat)])
                ->setCreatedBy($user[array_rand($user)])
                ->setCreatedAt($date)
                ->setUpdatedAt($date)
                ->setType($faker->boolean)
                ->setFeatured($faker->boolean)
                ->setPublished($faker->boolean)
                ->setArchived($faker->boolean)
                ->setSourceArticle("")
                ->setSourceImage("")
                ->addPlayer($player[array_rand($player)])
            ;
            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class,
            PlayerFixtures::class
        ];
    }
}