<?php

namespace App\Form;

use App\Entity\Confederation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfederationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('continent', ChoiceType::class, array(
                'choices' => array(
                    'Europe' => 0,
                    'Afrique' => 1,
                    'Asie' => 2,
                    'Amérique du Nord'   => 3,
                    'Amérique du Sud'   => 4,
                    'Océanie'   => 5
                ),
                'attr' => array('class' => 'form-control')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Confederation::class,
        ]);
    }
}
