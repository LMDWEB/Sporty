<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\ClubTeam;
use App\Entity\Stadium;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('club', EntityType::class , [
                'label' => 'club.name',
                'class' => Club::class,
                'choice_label' => 'name',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])
            ->add('team', EntityType::class , [
                'label' => 'team.name',
                'class' => Team::class,
                'choice_label' => function ($team) {
                    return $team->getName()." ".$team->getNameSection();
                },
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])
            ->add('year_creation', IntegerType::class, [
                'label' => 'clubteam.year',
                'attr' => array('class' => 'form-control')
            ])
            ->add('address', TextType::class, [
                'label' => 'address',
                'attr' => array('class' => 'form-control')
            ])
            ->add('stadium', EntityType::class , [
                'label' => 'game.stadium',
                'class' => Stadium::class,
                'choice_label' => 'name',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClubTeam::class,
        ]);
    }
}
