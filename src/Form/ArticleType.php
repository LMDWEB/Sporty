<?php

namespace App\Form;

use App\Entity\Article;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('date', DateTimeType::class, [
                'placeholder' => 'Select a value',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('featured', CheckboxType::class, array(
                'label'    => 'Article en une ?',
                'required' => false,
            ))
            ->add('image')
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Article' => 1,
                    'Contenu' => 2,
                    'Vidéos'   => 3,
                ),
            ))
            ->add('source_article')
            ->add('source_image')
            ->add('published', ChoiceType::class, array(
                'choices' => array(
                    'Publié' => 1,
                    'Brouillon' => 2,
                    'No publié'   => 3,
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
