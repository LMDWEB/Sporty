<?php

namespace App\DataFixtures;

use App\Entity\Thread;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ThreadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $thread = new Thread();
        $thread
            ->setName("Top 10 des meilleurs joueurs")
            ->setPublished(0)
        ;

        $manager->persist($thread);

        $manager->flush();
    }
}
