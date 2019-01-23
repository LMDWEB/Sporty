<?php

namespace App\DataFixtures;

use App\Entity\Configuration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ConfigurationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $configs = array(
            array(
                "name" => "namesite",
                "value" => "",
                "type" => 0,

            ),
            array(
                "name" => "description",
                "value" => "",
                "type" => 0,

            ),
            array(
                "name" => "facebook",
                "value" => "facebook.com/",
                "type" => 1,

            ),
            array(
                "name" => "twitter",
                "value" => "twitter.com/",
                "type" => 1,

            ),
            array(
                "name" => "instagram",
                "value" => "instagram.com/",
                "type" => 1,

            ),
        );

        foreach ($configs as  $config) {
            $configuration = new Configuration();
            $configuration
                ->setNameConfig($config['name'])
                ->setValueConfig($config['value'])
                ->setType($config['type']);
            ;

            $manager->persist($configuration);
        }


        $manager->flush();
    }
}
