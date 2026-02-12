<?php

namespace App\Form;

use App\Entity\Dechet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DechetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'placeholder' => 'Choisir un type',
                'choices' => [
                    'Plastique' => 'Plastique',
                    'Papier' => 'Papier',
                    'Verre' => 'Verre',
                    'Métal' => 'Métal',
                    'Biodéchets' => 'Biodéchets',
                    'Autre' => 'Autre',
                ],
                'attr' => ['class' => 'ww-input']
            ])

            ->add('quantiteKg', NumberType::class, [
                'label' => 'Quantité (kg)',
                'required' => true,
                // ✅ pas de min/step HTML (contrôle serveur)
                'attr' => [
                    'class' => 'ww-input',
                    'placeholder' => 'Ex: 2.5',
                ],
            ])

            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
                'attr' => [
                    'class' => 'ww-input',
                    'placeholder' => 'Clique sur la carte pour choisir une localisation',
                    'readonly' => true
                ]
            ])

            ->add('latitude', HiddenType::class)
            ->add('longitude', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dechet::class,
        ]);
    }
}
