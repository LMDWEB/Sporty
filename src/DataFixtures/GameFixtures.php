<?php

namespace App\DataFixtures;

use App\Entity\ClubTeam;
use App\Entity\Competition;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Season;
use App\Entity\Stadium;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();

        $team = $manager->getRepository(Team::class)->findOneBy(["name" => "A"]);
        $clubH =  $manager->getRepository(ClubTeam::class)->findBy(["team" => $team]);
        $clubA =  $manager->getRepository(ClubTeam::class)->findBy(["team" => $team]);
        $referee =  $manager->getRepository(Player::class)->findBy(["status" => 1]);
        $competition =  $manager->getRepository(Competition::class)->findAll();
        $stadium =  $manager->getRepository(Stadium::class)->findAll();
        $season =  $manager->getRepository(Season::class)->findAll();

        for ($i = 0; $i < 100; $i++) {

            $game = (new Game())
                ->setTeamHome($clubH[array_rand($clubH)])
                ->setTeamAway($clubA[array_rand($clubA)])
                ->setReferee($referee[array_rand($referee)])
                ->setCompetition($competition[array_rand($competition)])
                ->setStadium($stadium[array_rand($stadium)])
                ->setSeason($season[array_rand($season)])
                ->setMatchday($faker->numberBetween(0, 38))
                ->setName("game")
                ->setDate($faker->dateTime)
            ;
            $manager->persist($game);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TeamFixtures::class,
            ClubTeamFixtures::class,
            PlayerFixtures::class,
            CompetitionFixtures::class,
            StadiumFixtures::class,
            SeasonFixtures::class,
            RefereeFixtures::class
        ];
    }
}
