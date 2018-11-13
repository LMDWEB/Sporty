<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            //->add('date')
            ->add('image')
            ->add('featured')
            ->add('views')
            ->add('type')
            ->add('source_article')
            ->add('source_image')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('published', ChoiceType::class, array(
                'choices' => array(
                    'Publié' => 1,
                    'Brouillon' => 2,
                    'No publié'   => 3,
                ),
            ))
            ->add('archived')
            ->add('position')
            ->add('tags')
            //->add('user')
            //->add('player')
            //->add('game')
            //->add('season')
            //->add('threads')
            //->add('poll')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
