<?php

namespace App\Form;

use App\Entity\Campagne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampagneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class, ['required' => false])
            ->add('dateDebut', DateType::class, ['widget' => 'single_text'])
            ->add('dateFin', DateType::class, ['widget' => 'single_text'])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Brouillon' => Campagne::STATUT_BROUILLON,
                    'Active' => Campagne::STATUT_ACTIVE,
                    'Terminée' => Campagne::STATUT_TERMINEE,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Campagne::class]);
    }
}
