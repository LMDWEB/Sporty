<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MenuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $menuArray = array(
            array("name" => "menu left"),
            array("name" => "menu right")
        );

        foreach ($menuArray as $menuA) {
            $menu = new Menu();
            $menu
                ->setName($menuA['name'])
                ->setPublished(0)
            ;

            $manager->persist($menu);
        }
        $manager->flush();
    }
}
