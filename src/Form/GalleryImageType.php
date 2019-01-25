<?php

namespace App\Form;

use App\Entity\GalleryImage;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageName', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('published', ChoiceType::class, array(
                'choices' => array(
                    'Non publié'   => 0,
                    'Publié' => 1,
                    'Brouillon' => 2
                ),
                'attr' => array('class' => 'form-control')

            ))
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GalleryImage::class,
        ]);
    }
}
