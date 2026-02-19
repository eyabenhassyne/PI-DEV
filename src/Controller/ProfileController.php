<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CitoyenProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/citoyen')]
#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/profil', name: 'citoyen_profile_show', methods: ['GET'])]
    public function show(): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        return $this->render('citoyen/profile/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil/modifier', name: 'citoyen_profile_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $form = $this->createForm(CitoyenProfileType::class, $user, [
            'is_edit' => true,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ✅ Gestion changement mot de passe (optionnel)
            $newPassword = $form->has('newPassword') ? $form->get('newPassword')->getData() : null;
            $currentPassword = $form->has('currentPassword') ? $form->get('currentPassword')->getData() : null;

            // ✅ RepeatedType => peut être array (first/second) ou string selon versions/config
            if (is_array($newPassword)) {
                $newPassword = $newPassword['first'] ?? '';
            }

            $newPassword = is_string($newPassword) ? trim($newPassword) : '';
            $currentPassword = is_string($currentPassword) ? trim($currentPassword) : '';

            // ✅ Si l’utilisateur veut changer le mot de passe
            if ($newPassword !== '') {

                // Exiger ancien mdp
                if ($currentPassword === '') {
                    $form->get('currentPassword')->addError(new FormError('Veuillez saisir votre mot de passe actuel.'));
                } elseif (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                    $form->get('currentPassword')->addError(new FormError('Mot de passe actuel incorrect.'));
                } else {
                    // OK -> hash + update
                    $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
                }
            }

            // ✅ s’il y a des erreurs ajoutées après
            if ($form->isValid()) {
                $em->flush();
                $this->addFlash('success', '✅ Profil mis à jour avec succès.');
                return $this->redirectToRoute('citoyen_profile_show');
            }
        }

        return $this->render('citoyen/profile/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    // ✅ AJOUT : Route test face-api
    #[Route('/face-test', name: 'citoyen_face_test', methods: ['GET'])]
    public function faceTest(): Response
    {
        return $this->render('citoyen/face/face_test.html.twig');
    }
}
