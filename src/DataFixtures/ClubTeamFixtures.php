<?php

namespace App\DataFixtures;

use App\Entity\Club;
use App\Entity\ClubTeam;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClubTeamFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $clubs =  $manager->getRepository(Club::class)->findAll();
        $teams =  $manager->getRepository(Team::class)->findAll();

        foreach ($clubs as  $club) {
            foreach ($teams as  $team) {

                $clubTeam = new ClubTeam();
                $clubTeam
                    ->setName("")
                    ->setTeam("")
                    ->setYearCreation('')
                    ->setAddress("")
                    ->setClub("")
                ;

                $manager->persist($clubTeam);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClubFixtures::class,
            TeamFixtures::class
        ];
    }
}
