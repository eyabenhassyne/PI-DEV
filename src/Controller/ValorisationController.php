<?php

namespace App\Controller;

use App\Entity\Dechet;
use App\Service\DechetMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ValorisationController extends AbstractController
{
    #[Route('/valorisateur/dechet/{id}/valider', name: 'val_dechet_valider', methods: ['POST'])]
    public function valider(
        Dechet $dechet,
        Request $request,
        EntityManagerInterface $em,
        DechetMailer $mailer
    ): RedirectResponse {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        // ✅ CSRF
        $token = (string) $request->request->get('_token', '');
        if (!$this->isCsrfTokenValid('dechet_validate_' . $dechet->getId(), $token)) {
            $this->addFlash('danger', 'Action refusée (CSRF invalide).');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ Déjà traité ?
        if ($dechet->getStatut() !== Dechet::STATUT_EN_ATTENTE) {
            $this->addFlash('warning', 'Cette déclaration a déjà été traitée.');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ Statut + trace
        $dechet->setStatut(Dechet::STATUT_VALIDE);
        $dechet->setValidatedAt(new \DateTimeImmutable());

        $user = $this->getUser();
        if ($user) {
            // Si validatedBy est une relation vers User
            $dechet->setValidatedBy($user);
        }

        // ✅ EcoPoints : estimation (ou 0)
        $points = (int) ($dechet->getEstimationEcoPoints() ?? 0);
        if ($points < 0) {
            $points = 0;
        }
        $dechet->setEcoPointsAttribues($points);

        // ✅ Créditer le citoyen
        $citoyen = $dechet->getUser();
        if ($citoyen && method_exists($citoyen, 'addEcoPoints')) {
            $citoyen->addEcoPoints($points);
        }

        $em->flush();

        // ✅ Email auto (on évite de casser la page si problème mail)
        try {
            $mailer->sendDechetValide($dechet);
        } catch (\Throwable $e) {
            $this->addFlash('warning', 'Déclaration validée, mais email non envoyé.');
        }

        $this->addFlash('success', 'Déclaration validée ✅ + ' . $points . ' EcoPoints attribués.');
        return $this->redirectToRoute('app_dashboard_valorizateur');
    }

    #[Route('/valorisateur/dechet/{id}/refuser', name: 'val_dechet_refuser', methods: ['POST'])]
    public function refuser(
        Dechet $dechet,
        Request $request,
        EntityManagerInterface $em,
        DechetMailer $mailer
    ): RedirectResponse {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        // ✅ CSRF
        $token = (string) $request->request->get('_token', '');
        if (!$this->isCsrfTokenValid('dechet_refuse_' . $dechet->getId(), $token)) {
            $this->addFlash('danger', 'Action refusée (CSRF invalide).');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ Déjà traité ?
        if ($dechet->getStatut() !== Dechet::STATUT_EN_ATTENTE) {
            $this->addFlash('warning', 'Cette déclaration a déjà été traitée.');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ Statut + trace
        $dechet->setStatut(Dechet::STATUT_REFUSE);
        $dechet->setValidatedAt(new \DateTimeImmutable());

        $user = $this->getUser();
        if ($user) {
            $dechet->setValidatedBy($user);
        }

        // ✅ Pas de points
        $dechet->setEcoPointsAttribues(0);

        $em->flush();

        // ✅ Email auto
        try {
            $mailer->sendDechetRefuse($dechet);
        } catch (\Throwable $e) {
            $this->addFlash('warning', 'Déclaration refusée, mais email non envoyé.');
        }

        $this->addFlash('success', 'Déclaration refusée ❌');
        return $this->redirectToRoute('app_dashboard_valorizateur');
    }
}
