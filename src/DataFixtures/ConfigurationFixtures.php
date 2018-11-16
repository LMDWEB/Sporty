<?php

namespace App\DataFixtures;

use App\Entity\Configuration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ConfigurationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $config = new Configuration();
        $config->setNameConfig('name_site')
            ->setValueConfig('Le Meilleur du PSG');
        $manager->persist($config);

        $manager->flush();
    }
}
