<?php

namespace App\Form;

use App\Entity\ClubTeam;
use App\Entity\Player;
use App\Entity\PlayerMercato;
use App\Entity\Season;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerMercatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                $builder->create('player', FormType::class, array('by_reference' => false))
                ->add('season', EntityType::class , [
                    'label' => 'season.name',
                    'class' => Season::class,
                    'choice_label' => 'season_year',
                    'required'=> true,
                    'attr' => array('class' => 'form-control')
                ])

                ->add('team', EntityType::class , [
                    'label' => 'club.name',
                    'class' => ClubTeam::class,
                    'choice_label' => 'name',
                    'required'=> true,
                    'attr' => array('class' => 'form-control')
                ])

                ->add('type', ChoiceType::class, array(
                    'choices' => array(
                        'Achat' => 0,
                        'Prêt' => 1
                    ),
                    'attr' => array('class' => 'form-control')
                ))
            )
            ->add(
                $builder->create('cost', FormType::class, array(
                    'by_reference' => false))
                ->add('date', BirthdayType::class, array(
                    'label' => 'date.start',
                    'attr' => array('class' => 'form-control')
                ))

                ->add('endContract', DateType::class, array(
                    'label' => 'date.end',
                    'attr' => array('class' => 'form-control')
                ))

                ->add('cost', NumberType::class, array(
                    'label' => 'mercato.cost',
                    'attr' => array('class' => 'form-control')
                ))
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayerMercato::class,
        ]);
    }
}
