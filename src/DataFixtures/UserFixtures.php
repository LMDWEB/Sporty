<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //$faker = Factory::create('fr_FR');

        $user = new User();
        $user->setFirstName('test')
             ->setLastName('test')
             ->setUsername('test')
             ->setEmail('test@test.fr')
             ->setPassword($this->encoder->encodePassword($user, 'password'));

        $manager->persist($user);
        $manager->flush();
    }
}