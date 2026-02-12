<?php

namespace App\Form;

use App\Entity\DeclarationDechet;
use App\Entity\TypeDechet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class DeclarationDechetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeDechet', EntityType::class, [
                'class' => TypeDechet::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Sélectionner un type...',
                'label' => 'Type de déchet *'
            ])

            ->add('quantite', NumberType::class, [
                'label' => 'Quantité *',
                'attr' => [
                    'placeholder' => 'Ex: 5',
                    'min' => '1',
                    'required' => 'required'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La quantité est obligatoire']),
                    new Assert\Positive(['message' => 'La quantité doit être un nombre positif']),
                    new Assert\Type(['type' => 'numeric', 'message' => 'La quantité doit être un nombre'])
                ]
            ])

            ->add('unite', ChoiceType::class, [
                'label' => 'Unité *',
                'choices' => [
                    'Kilogrammes (kg)' => 'kg',
                    'Litres (L)' => 'L',
                    'Mètres cubes (m³)' => 'm3',
                    'Pièces' => 'pieces'
                ]
            ])

            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'rows' => 4,
                    'placeholder' => 'Décrivez l\'état du déchet, ses caractéristiques...',
                    'minlength' => '10'
                ],
                'constraints' => [
                    new Assert\Length([
                        'min' => 10,
                        'minMessage' => 'La description doit contenir au minimum 10 caractères',
                        'max' => 5000,
                        'maxMessage' => 'La description ne doit pas dépasser 5000 caractères'
                    ])
                ]
            ])

            ->add('photoFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Photo du déchet *',
                'attr' => [
                    'accept' => 'image/*'
                ],
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/webp'
                        ],
                        'mimeTypesMessage' => 'Format autorisé: JPEG, PNG, GIF, WebP'
                    ])
                ]
            ])

            ->add('latitude', NumberType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['hidden' => true]
            ])

            ->add('longitude', NumberType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['hidden' => true]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeclarationDechet::class,
        ]);
    }
}
