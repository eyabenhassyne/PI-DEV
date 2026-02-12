<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {
        $user = new User();
        $user->setIsVerified(false);

        // ✅ (optionnel mais conseillé) rôle par défaut
        if (method_exists($user, 'setRoles')) {
            $user->setRoles(['ROLE_USER']);
        }

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plainPassword = (string) $form->get('plainPassword')->getData();

            // ✅ sécurité : mot de passe obligatoire
            if ($plainPassword === '') {
                $this->addFlash('danger', 'Le mot de passe est obligatoire.');
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            $user->setPassword($hasher->hashPassword($user, $plainPassword));

            $em->persist($user);
            $em->flush();

            // ✅ Email de vérification
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@wastewise.tn', 'WasteWise TN'))
                    ->to(new Address((string) $user->getEmail()))
                    ->subject('Confirme ton email - WasteWise TN')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            $this->addFlash('success', 'Compte créé ✅ Vérifie ton email avant de te connecter.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email', methods: ['GET'])]
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        // ✅ le lien contient ?id=...
        $id = $request->query->get('id');

        if (!$id) {
            $this->addFlash('danger', 'Lien de vérification invalide (id manquant).');
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (!$user) {
            $this->addFlash('danger', 'Utilisateur introuvable.');
            return $this->redirectToRoute('app_register');
        }

        try {
            // ✅ IMPORTANT : on passe le USER récupéré, PAS $this->getUser()
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (\Throwable $e) {
            $this->addFlash('danger', 'Lien de vérification invalide ou expiré.');
            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('success', 'Email vérifié ✅ Tu peux te connecter.');
        return $this->redirectToRoute('app_login');
    }
}
