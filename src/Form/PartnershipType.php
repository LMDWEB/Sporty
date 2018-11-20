<?php

namespace App\Form;

use App\Entity\Partnership;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnershipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('description', TextareaType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('image', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('link', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partnership::class,
        ]);
    }
}
