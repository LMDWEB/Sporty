<?php

namespace App\Form;

use App\Entity\ClubTeam;
use App\Entity\Event;
use App\Entity\Team;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre',
                'attr' => array('class' => 'form-control')
            ))
            ->add('status', ChoiceType::class, array(

                'label' => 'Statut',

                'choices' => array(
                    'Publié' => 1,
                    'En cours d\'examen' => 2,
                    'Non publié' => 0
                ),

                'attr' => array('class' => 'form-control')
            ))

            ->add('description', TextareaType::class, array(
                'label' => 'Déscription',
                'attr' => array('class' => 'form-control')
            ))

            ->add('start_date', DateType::class, array(
                'label' => 'Date de début de l\'événement',
                'attr' => array('class' => 'form-control')
            ))
            ->add('end_date', DateType::class, array(
                'label' => 'Date de fin de l\'événement',
                'attr' => array('class' => 'form-control')
            ))
            ->add('max_participant', IntegerType::class, array(
                'label' => 'Nombre de participants maximale',
                'attr' => array('class' => 'form-control')
            ))
            ->add('organizers', EntityType::class , [
                'label' => 'Organisateur(s)',
                'class' => User::class,
                'choice_label' => 'username',
                'multiple' => true,
                'required'=> true,
                'attr' => array('id' => 'event_organizer')
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
