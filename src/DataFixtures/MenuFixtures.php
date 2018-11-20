<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MenuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $menu = new Menu();
        $menu
            ->setName("null")
            ->setPublished(0)
            ->setParent(false)
        ;

        $manager->persist($menu);

        $manager->flush();
    }
}
