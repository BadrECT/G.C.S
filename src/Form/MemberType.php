<?php

namespace App\Form;

use App\Entity\Membre;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('telephone', null, ['label' => 'Téléphone'])
            ->add('categorie', null, ['label' => 'Catégorie'])
            ->add('statut', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
                'choices'  => [
                    'Actif' => 'actif',
                    'Inactif' => 'inactif',
                ],
                'label' => 'Statut'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
