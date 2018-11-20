<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Club;
use App\Entity\ClubTeam;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Thread;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('resume', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('content', TextareaType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('category', EntityType::class, [
                'label'        => 'Category',
                'class'        => Category::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'required'     => false,
                'attr' => array('class' => 'form-control')
            ])
            ->add('date', DateTimeType::class, [
                'placeholder' => 'Select a value'
            ])
            ->add('featured', CheckboxType::class, array(
                'label'    => 'Article en une ?',
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Article' => 0,
                    'Contenu' => 1,
                    'Vidéos'   => 2,
                ),
                'attr' => array('class' => 'form-control')
            ))
            ->add('source_article', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('source_image', TextType::class, array(
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
            ->add('club', EntityType::class, [
                'label'        => 'Club',
                'class'        => ClubTeam::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
                'attr' => array('id' => 'article_club')
            ])
            ->add('game', EntityType::class, [
                'label'        => 'Game',
                'class'        => Game::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
                'attr' => array('id' => 'article_game')
            ])
            ->add('player', EntityType::class, [
                'label'        => 'Player',
                'class'        => Player::class,
                'choice_label' => function ($player) {
                    return $player->getFirstname()." ".$player->getLastname();
                },
                'multiple'     => true,
                'required'     => false,
                'attr' => array('id' => 'article_player')
            ])
            ->add('thread', EntityType::class, [
                'label'        => 'Thread',
                'class'        => Thread::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
                'attr' => array('id' => 'article_thread')
            ])
            ->add('created_by', EntityType::class, [
                'label'        => 'Author',
                'class'        => User::class,
                'choice_label' => 'firstname',
                'multiple'     => false,
                'required'     => false,
                'attr' => array('class' => 'form-control')
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
