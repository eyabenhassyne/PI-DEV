<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType; // Badelna l'import bech n-zidu el waqt
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'événement',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: Nettoyage plage La Marsa'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => 'Détails sur l\'action écologique...'
                ]
            ])
            // --- EL ISLAH HNA: ZIDNA EL LIEU (ADRESSE) ---
            ->add('lieu', TextType::class, [
                'label' => 'Adresse / Lieu',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: La Marsa, Tunis'
                ]
            ])
            // --- EL ISLAH HNA: DateTimeType bech l'admin yakhtar el waqt zeda ---
            ->add('dateHeure', DateTimeType::class, [
                'label' => 'Date et Heure',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'min' => (new \DateTime())->format('Y-m-d\TH:i') // Blocki el passé m3a el waqt
                ]
            ])
            ->add('nomOrganisateur', TextType::class, [
                'label' => 'Nom de l\'organisateur',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: Association WasteWise'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
