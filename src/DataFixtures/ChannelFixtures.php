<?php

namespace App\DataFixtures;

use App\Entity\Channel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ChannelFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $channel = new Channel();
        $channel
            ->setName('Canal +')
            ->setImage('canal.png')
        ;

        $manager->persist($channel);

        $manager->flush();
    }
}
