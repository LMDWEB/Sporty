<?php

namespace App\Form;

use App\Entity\ClubTeam;
use App\Entity\Competition;
use App\Entity\Season;
use App\Entity\SeasonCompetition;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeasonCompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('competition', EntityType::class, [
                'label'        => 'Competition',
                'class'        => Competition::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'required'     => false,
                'attr' => array('class' => 'form-control')
            ])

            ->add('image', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))

            ->add('numberParticipate', NumberType::class, array(
                'label' => 'participate',
                'attr' => array('class' => 'form-control')
            ))

            ->add('season', EntityType::class, [
                'label'        => 'Season',
                'class'        => Season::class,
                'choice_label' => 'season_year',
                'multiple'     => false,
                'required'     => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('teams', EntityType::class, [
                'label'        => 'Club',
                'class'        => ClubTeam::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
                'attr' => array('id' => 'season_competition_teams')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SeasonCompetition::class,
        ]);
    }
}
