<?php

namespace App\Form;

use App\Entity\Channel;
use App\Entity\ClubTeam;
use App\Entity\Competition;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Season;
use App\Entity\Stadium;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $matchday = new Game();

        $builder
            ->add('matchday', ChoiceType::class, array(
                'label' => 'game.matchday',
                'choices' => array(
                    $matchday->listMatchDay()
                ),
                'attr' => array('class' => 'form-control')
            ))

            ->add('channel', EntityType::class , [
                'label' => 'game.channel',
                'class' => Channel::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required'=> false,
                'attr' => array('class' => 'selectize')
            ])

            ->add('date', DateType::class , [
                'label' => 'game.date',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])

            ->add('team_home', EntityType::class , [
                'label' => 'game.teamHome',
                'class' => ClubTeam::class,
                'choice_label' => 'name',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])

            ->add('team_away', EntityType::class , [
                'label' => 'game.teamAway',
                'class' => ClubTeam::class,
                'choice_label' => 'name',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])

            ->add('players', EntityType::class, [
                'label'        => 'game.add_players',
                'class'        => Player::class,
                'choice_label' => function ($player) {
                    return $player->getFirstname()." ".$player->getLastname();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.status = 0');
                },
                'multiple'     => true,
                'required'     => false,
                'attr' => array('class' => 'selectize')

            ])

            ->add('referee' , EntityType::class , [
                'label' => 'game.referee',
                'class' => Player::class,
                'choice_label' => function ($referee) {
                    return $referee->getFirstname()." ".$referee->getLastname();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.status = 1');
                },
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])

            ->add('competition' , EntityType::class , [
                'label' => 'game.competition',
                'class' => Competition::class,
                'choice_label' => 'name',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])

            ->add('stadium', EntityType::class , [
                'label' => 'game.stadium',
                'class' => Stadium::class,
                'choice_label' => 'name',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])

            ->add('season' , EntityType::class , [
                'label' => 'game.season',
                'class' => Season::class,
                'choice_label' => 'season_year',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
