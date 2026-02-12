<?php

namespace App\Form;

use App\Entity\AppelOffre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AppelOffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(message: 'Le titre est obligatoire.'),
                    new Assert\Length(max: 160, maxMessage: 'Max 160 caractères.'),
                ],
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Brouillon' => 'BROUILLON',
                    'Publié' => 'PUBLIE',
                    'Fermé' => 'FERME',
                ],
                'constraints' => [
                    new Assert\NotBlank(message: 'Le statut est obligatoire.'),
                ],
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length(max: 5000, maxMessage: 'Max 5000 caractères.'),
                ],
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(message: 'La date début est obligatoire.'),
                    new Assert\GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date début ne peut pas être dans le passé.',
                    ]),
                ],
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(message: 'La date fin est obligatoire.'),
                    // ✅ La règle "dateFin >= dateDebut + 3 jours" est gérée dans l'Entity (Callback)
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AppelOffre::class,
        ]);
    }
}
