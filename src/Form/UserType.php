<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'user.firstname',
                'attr' => array('class' => 'form-control')
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'user.lastname',
                'attr' => array('class' => 'form-control')
            ))
            ->add('username', TextType::class, array(
                'label' => 'user.username',
                'attr' => array('class' => 'form-control')
            ))
            ->add('email', TextType::class, array(
                'label' => 'user.email',
                'attr' => array('class' => 'form-control')
            ))
           /* ->add('roles', EntityType::class, [
                'label'        => 'Role',
                'class'        => Role::class,
                'choice_label' => function ($role) {
                    return $role->getTitle();
                },
                'multiple'     => true,
                'required'     => false,
                'attr' => array('id' => 'role')
            ])*/
        //      ->add('password')
//            ->add('roles')
          //  ->add('todolists')
            //->add('events')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
