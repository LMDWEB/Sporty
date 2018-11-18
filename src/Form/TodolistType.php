<?php

namespace App\Form;

use App\Entity\Todolist;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodolistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'todolist.title',
                'attr' => array('class' => 'form-control')
            ))
            ->add('content', TextareaType::class, array(
                'label' => 'content',
                'attr' => array('class' => 'form-control')
            ))
            ->add('status', ChoiceType::class, array(
                'label' => 'status',
                'choices' => array(
                    'wip' => 0,
                    'todo' => 1,
                    'important'   => 2,
                ),
                'attr' => array('class' => 'form-control')
            ))
            ->add('assignedUser', EntityType::class, [
                'label'        => 'author',
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
            'data_class' => Todolist::class,
        ]);
    }
}
