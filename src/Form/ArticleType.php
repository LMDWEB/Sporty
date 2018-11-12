<?php

namespace App\Form;

use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('tags', EntityType::class, [
                'label'        => 'Tag',
                'class'        => Tag::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'required'     => false,
            ])
        ;
    }
}