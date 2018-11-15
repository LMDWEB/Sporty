<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, array(
                'choices' => array(
                    'Joueur' => 0,
                    'Arbitre' => 1,
                    'Président'   => 2,
                ),
            ))
            ->add('firstname')
            ->add('lastname')
            ->add('display_name')
            ->add('surname')
            ->add('dateBirth', BirthdayType::class)
            ->add('city_birth')
            ->add('foot', ChoiceType::class, array(
                'choices' => array(
                    'Droitier' => 0,
                    'Gaucher' => 1,
                    'Ambidextre'   => 2,
                ),
            ))
            ->add('nationality', CountryType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
