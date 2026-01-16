<?php

namespace App\Form;

use App\Entity\Paiement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant', null, ['label' => 'Montant (€)'])
            ->add('motif', null, ['label' => 'Motif'])
            ->add('datePaiement', null, [
                'widget' => 'single_text',
                'label' => 'Date du paiement'
            ])
            ->add('statut', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
                'choices' => [
                    'Payé' => 'payé',
                    'En attente' => 'en_attente',
                    'Annulé' => 'annulé'
                ],
                'label' => 'Statut'
            ])
            ->add('membre', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'label' => 'Membre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paiement::class,
        ]);
    }
}
