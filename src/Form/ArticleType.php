<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Club;
use App\Entity\Player;
use App\Entity\Thread;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('resume')
            ->add('content')
            ->add('category', EntityType::class, [
                'label'        => 'Category',
                'class'        => Category::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'required'     => false,
            ])
            ->add('date', DateTimeType::class, [
                'placeholder' => 'Select a value',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('featured', CheckboxType::class, array(
                'label'    => 'Article en une ?',
                'required' => false,
            ))
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Article' => 0,
                    'Contenu' => 1,
                    'Vidéos'   => 2,
                ),
            ))
            ->add('source_article')
            ->add('source_image')
            ->add('published', ChoiceType::class, array(
                'choices' => array(
                    'Publié' => 1,
                    'Brouillon' => 2,
                    'Non publié'   => 0,
                ),
            ))
            ->add('club', EntityType::class, [
                'label'        => 'Club',
                'class'        => Club::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
            ])
            ->add('player', EntityType::class, [
                'label'        => 'Player',
                'class'        => Player::class,
                'choice_label' => function ($player) {
                    return $player->getFirstname()." ".$player->getLastname();
                },
                'multiple'     => true,
                'required'     => false,
                'attr' => array('class' => 'form-control', 'id' => 'select-player')
            ])
            ->add('created_by', EntityType::class, [
                'label'        => 'Author',
                'class'        => User::class,
                'choice_label' => 'firstname',
                'multiple'     => false,
                'required'     => false,
            ])
            ->add('thread', EntityType::class, [
                'label'        => 'Thread',
                'class'        => Thread::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
