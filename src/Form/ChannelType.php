<?php

namespace App\Form;

use App\Entity\Channel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChannelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name' , TextType::class , [
                'label' => 'Nom',
                'required'=> true,
                'attr' => array('class' => 'form-control')
            ])

            ->add('image' , TextType::class , [
                'label' => 'Image',
                'required'=> false,
                'attr' => array('class' => 'form-control')
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Channel::class,
        ]);
    }
}
