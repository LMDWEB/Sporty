<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('username')
            ->add('email')
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
