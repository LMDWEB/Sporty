<?php

namespace App\Form;

use App\Entity\Configuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameConfig', TextType::class, array(
                'label'    => 'config.setValue',
                'attr' => array('class' => 'form-control')
            ))
            ->add('valueConfig', TextType::class, array(
                'label'    => 'config.value',
                'attr' => array('class' => 'form-control')
            ))
            ->add('type', ChoiceType::class, array(
                'label'    => 'type',
                'choices' => array(
                    'website' => 0,
                    'social' => 1
                ),
                    'attr' => array('class' => 'form-control')
                )
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class,
        ]);
    }
}
