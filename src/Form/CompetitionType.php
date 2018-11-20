<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Confederation;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('section', EntityType::class , [
                'label' => 'team.name',
                'class' => Team::class,
                'choice_label' => 'name',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])
            ->add('format', ChoiceType::class, array(
                'choices' => array(
                    'Championnat' => 0,
                    'Poule' => 1,
                    'Coupe'   => 2,
                    'Supercoupe'   => 3,
                ),
                'attr' => array('class' => 'form-control')
            ))
            ->add('confederation', EntityType::class , [
                'label' => 'confederation.name',
                'class' => Confederation::class,
                'choice_label' => 'name',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])
            ->add('division', ChoiceType::class, array(
                'choices' => array(
                    'Aucune' => 0,
                    '1ère division' => 1,
                    '2ème division' => 2,
                    '3ème division'   => 3,
                    '4ème division'   => 4,
                    '5ème division'   => 5,
                    '6ème division'   => 6
                ),
                'attr' => array('class' => 'form-control')
            ))
            ->add('typeClub', ChoiceType::class, array(
                'choices' => array(
                    'Club' => 0,
                    'Sélection' => 1
                ),
                'attr' => array('class' => 'form-control')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
