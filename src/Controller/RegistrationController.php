<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
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

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {
        $user = new User();
        $user->setIsVerified(false); // ✅ par défaut non vérifié

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ✅ HASH password (sinon "Invalid credentials" au login)
            $plainPassword = (string) $form->get('plainPassword')->getData();
            $user->setPassword($hasher->hashPassword($user, $plainPassword));

            // ✅ Persist user
            $em->persist($user);
            $em->flush();

            // ✅ Send verification email
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@wastewise.tn', 'WasteWise TN'))
                    ->to((string) $user->getEmail()) // ✅ important
                    ->subject('Confirme ton email - WasteWise TN')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            $this->addFlash('success', 'Compte créé ✅ Vérifie ton email avant de te connecter.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(), // ✅ important
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        // ✅ IMPORTANT :
        // On ne force PAS l'utilisateur à être connecté.
        // Le lien dans l'email contient une signature sécurisée.

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (\Throwable $e) {
            $this->addFlash('danger', 'Lien de vérification invalide ou expiré.');
            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('success', 'Email vérifié ✅ Tu peux te connecter.');
        return $this->redirectToRoute('app_login');
    }
}
