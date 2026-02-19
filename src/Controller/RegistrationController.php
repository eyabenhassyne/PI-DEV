<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Security\AppAuthenticator;

class RegistrationController extends AbstractController
{
    private function dashboardRouteFor(User $user): string
    {
        return match ($user->getType()) {
            User::TYPE_ADMIN => 'app_dashboard_admin',
            User::TYPE_VALORIZER => 'app_dashboard_valorizateur',
            default => 'app_dashboard_citoyen',
        };
    }

    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher,
        UserAuthenticatorInterface $userAuthenticator,
        AppAuthenticator $authenticator
    ): Response {
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plainPassword = (string) $form->get('plainPassword')->getData();
            if ($plainPassword === '') {
                $this->addFlash('danger', 'Le mot de passe est obligatoire.');
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            $user->setPassword($hasher->hashPassword($user, $plainPassword));

            // ✅ Embedding visage optionnel
            $raw = $request->request->get('faceEmbedding');
            if (is_string($raw) && trim($raw) !== '') {
                $arr = json_decode($raw, true);
                if (is_array($arr) && count($arr) >= 64) {
                    $clean = [];
                    foreach ($arr as $v) {
                        $f = (float) $v;
                        if (is_finite($f)) $clean[] = $f;
                    }
                    if (count($clean) >= 64) {
                        $user->setFaceEmbedding($clean);
                    }
                }
            }

            $em->persist($user);
            $em->flush();

            // ✅ Auto-login
            $userAuthenticator->authenticateUser($user, $authenticator, $request);

            // ✅ Redirect dynamique (selon type)
            return $this->redirectToRoute($this->dashboardRouteFor($user));
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
