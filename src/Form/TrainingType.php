<?php

namespace App\Form;

use App\Entity\Entrainement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, ['label' => 'Titre de la séance'])
            ->add('description', null, ['label' => 'Description'])
            ->add('dateHeure', null, [
                'widget' => 'single_text',
                'label' => 'Date et Heure'
            ])
            ->add('lieu', null, ['label' => 'Lieu'])
            ->add('placesMax', null, ['label' => 'Nombre de places maximum'])
            ->add('coach', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'label' => 'Coach (Admin/Entraîneur)',
                'query_builder' => function (\App\Repository\UserRepository $ur) {
                    return $ur->createQueryBuilder('u')
                        ->where('u.role = :role')
                        ->setParameter('role', 'admin');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entrainement::class,
        ]);
    }
}
