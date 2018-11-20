<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, array(
                'label' => 'status',
                'choices' => array(
                    'player.name' => 0,
                    'referee' => 1,
                    'owner'   => 2,
                ),
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'player.firstname',
                'attr' => array('class' => 'form-control')
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'player.lastname',
                'attr' => array('class' => 'form-control')
            ))
            ->add('surname', TextType::class, array(
                'label' => 'player.surname',
                'attr' => array('class' => 'form-control')
            ))
            ->add('dateBirth', BirthdayType::class, array(
                'label' => 'player.date',
                'attr' => array('class' => 'form-control')
            ))
            ->add('city_birth', TextType::class, array(
                'label' => 'player.city',
                'attr' => array('class' => 'form-control')
            ))
            ->add('foot', ChoiceType::class, array(
                'label' => 'player.foot.name',
                'choices' => array(
                    'player.foot.right' => 0,
                    'player.foot.left' => 1,
                    'player.foot.both'   => 2,
                ),
                'attr' => array('class' => 'form-control')
            ))
            ->add('nationality', CountryType::class, array(
                'label' => 'player.nationality',
                'attr' => array('class' => 'form-control')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
