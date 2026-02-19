<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CitoyenProfileType; // tu peux réutiliser le même form
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/valorisateur')]
#[IsGranted('ROLE_VALORIZER')]
class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'valorisateur_profile_show', methods: ['GET'])]
    public function show(): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        return $this->render('valorisateur/profil/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil/modifier', name: 'valorisateur_profile_edit', methods: ['GET','POST'])]
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

            $newPassword = $form->has('newPassword') ? $form->get('newPassword')->getData() : null;
            $currentPassword = $form->has('currentPassword') ? $form->get('currentPassword')->getData() : null;

            if (is_array($newPassword)) {
                $newPassword = $newPassword['first'] ?? '';
            }

            $newPassword = is_string($newPassword) ? trim($newPassword) : '';
            $currentPassword = is_string($currentPassword) ? trim($currentPassword) : '';

            if ($newPassword !== '') {
                if ($currentPassword === '') {
                    $form->get('currentPassword')->addError(new FormError('Veuillez saisir votre mot de passe actuel.'));
                } elseif (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                    $form->get('currentPassword')->addError(new FormError('Mot de passe actuel incorrect.'));
                } else {
                    $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
                }
            }

            if ($form->isValid()) {
                $em->flush();
                $this->addFlash('success', '✅ Profil mis à jour avec succès.');
                return $this->redirectToRoute('valorisateur_profile_show');
            }
        }

        return $this->render('valorisateur/profil/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
