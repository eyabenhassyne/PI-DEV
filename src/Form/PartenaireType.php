<?php

namespace App\Form;

use App\Entity\Partenaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartenaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEntreprise', TextType::class, [
                'label' => "Nom de l’entreprise",
                'attr' => [
                    'placeholder' => 'Ex: Carrefour, Monoprix...',
                    'class' => 'ww-input'
                ],
            ])

            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Supermarché' => 'Supermarché',
                    'Restaurant' => 'Restaurant',
                    'Entreprise privée' => 'Entreprise privée',
                    'ONG / Association' => 'ONG',
                    'Startup' => 'Startup',
                    'Établissement public' => 'Public',
                    'Autre' => 'Autre',
                ],
                'placeholder' => '— Choisir une catégorie —',
                'attr' => [
                    'class' => 'ww-input'
                ],
            ])

            ->add('siteWeb', TextType::class, [
                'label' => 'Site web (optionnel)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'https://www.exemple.com',
                    'class' => 'ww-input'
                ],
            ])

            ->add('actif', CheckboxType::class, [
                'label' => 'Partenaire actif',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partenaire::class,
        ]);
    }
}
