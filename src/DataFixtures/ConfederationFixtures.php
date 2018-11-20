<?php

namespace App\DataFixtures;

use App\Entity\Confederation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ConfederationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $conf = (new Confederation())
            ->setName('UEFA')
            ->setContinent(1)
        ;

        $manager->persist($conf);

        $manager->flush();
    }
}