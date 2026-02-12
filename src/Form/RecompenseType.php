<?php

namespace App\Form;

use App\Entity\Partenaire;
use App\Entity\Recompense;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RecompenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'constraints' => [new Assert\NotBlank(), new Assert\Length(['max' => 140])],
            ])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('pointsNecessaires', IntegerType::class, [
                'constraints' => [new Assert\NotBlank(), new Assert\Positive()],
            ])
            ->add('stock', IntegerType::class, [
                'constraints' => [new Assert\NotBlank(), new Assert\GreaterThanOrEqual(0)],
            ])
            ->add('partenaire', EntityType::class, [
                'class' => Partenaire::class,
                'choice_label' => 'nomEntreprise',
                'placeholder' => '— Choisir un partenaire —',
                'constraints' => [new Assert\NotNull(message: 'Veuillez choisir un partenaire.')],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Recompense::class]);
    }
}
