<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TwoFactorSetupController extends AbstractController
{
    #[Route('/profile/2fa/manual', name: 'app_2fa_manual', methods: ['GET', 'POST'])]
    public function manual(
        Request $request,
        EntityManagerInterface $em,
        GoogleAuthenticatorInterface $google
    ): Response {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        if ($request->isMethod('POST')) {
            $secret = strtoupper(trim((string) $request->request->get('secret')));
            $secret = preg_replace('/[^A-Z2-7]/', '', $secret);

            $code = trim((string) $request->request->get('code'));

            if (strlen($secret) < 16) {
                $this->addFlash('danger', 'Secret invalide (trop court).');
                return $this->redirectToRoute('app_2fa_manual');
            }

            if (!preg_match('/^\d{6}$/', $code)) {
                $this->addFlash('danger', 'Code invalide (6 chiffres).');
                return $this->redirectToRoute('app_2fa_manual');
            }

            // ✅ vérifier le code avant d'activer
            $tmpUser = clone $user;
            $tmpUser->setGoogleAuthenticatorSecret($secret);

            if (!$google->checkCode($tmpUser, $code)) {
                $this->addFlash('danger', 'Code invalide. Vérifie Google Authenticator (heure du téléphone).');
                return $this->redirectToRoute('app_2fa_manual');
            }

            $user->setGoogleAuthenticatorSecret($secret);
            $user->setIsTwoFactorEnabled(true);
            $em->flush();

            $this->addFlash('success', '2FA activée ✅. Déconnecte-toi puis reconnecte-toi.');
            return $this->redirectToRoute('app_logout');
        }

        return $this->render('security/2fa_manual.html.twig');
    }
}