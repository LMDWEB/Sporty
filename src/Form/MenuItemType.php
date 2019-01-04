<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\MenuItem;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('url', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('icon', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('color', ColorType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('parent', EntityType::class, [
                'label'        => 'Menu',
                'class'        => Menu::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'required'     => true,
                'attr' => array('class' => 'form-control')
            ])
            ->add('subParent', CheckboxType::class, array(
                'label'    => 'Sous-menu ?',
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('parent_item', EntityType::class, [
                'label'        => 'Sous-menu',
                'class'        => MenuItem::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'required'     => true,
                'attr' => array('class' => 'form-control')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MenuItem::class,
        ]);
    }
}
