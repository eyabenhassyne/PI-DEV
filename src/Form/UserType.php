<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = (bool) $options['is_edit'];

        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Email obligatoire.']),
                    new Assert\Email(['message' => 'Email invalide.']),
                ],
            ])

            // ✅ password géré à la main (hash controller)
            ->add('password', PasswordType::class, [
                'required' => !$isEdit,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => $isEdit
                    ? [
                        new Assert\Length([
                            'min' => 6,
                            'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
                        ]),
                    ]
                    : [
                        new Assert\NotBlank(['message' => 'Mot de passe obligatoire.']),
                        new Assert\Length([
                            'min' => 6,
                            'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
                        ]),
                    ],
            ])

            ->add('nom', TextType::class, [
                'required' => true,
                'constraints' => [new Assert\NotBlank(['message' => 'Nom obligatoire.'])],
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'constraints' => [new Assert\NotBlank(['message' => 'Prénom obligatoire.'])],
            ])
            ->add('telephone', TextType::class, [
                'required' => false,
            ])

            // ✅ PAS DE PARTNER
            ->add('type', ChoiceType::class, [
                'required' => true,
                'placeholder' => 'Choisir un type',
                'choices' => [
                    'Citoyen' => User::TYPE_CITIZEN,
                    'Valorisateur' => User::TYPE_VALORIZER,
                    'Admin' => User::TYPE_ADMIN,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_edit' => false,
        ]);

        $resolver->setAllowedTypes('is_edit', 'bool');
    }
}
