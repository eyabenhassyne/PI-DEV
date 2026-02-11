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
        if (!$this->isCsrfTokenValid('dechet_validate_' . $dechet->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Action refusée (CSRF invalide).');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ déjà traité ?
        if ($dechet->getStatut() !== Dechet::STATUT_EN_ATTENTE) {
            $this->addFlash('warning', 'Cette déclaration a déjà été traitée.');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ statut + trace
        $dechet->setStatut(Dechet::STATUT_VALIDE);
        $dechet->setValidatedAt(new \DateTimeImmutable());
        $dechet->setValidatedBy($this->getUser());

        // ✅ EcoPoints définitifs : on prend l'estimation (ou 0)
        $points = (int) ($dechet->getEstimationEcoPoints() ?? 0);
        $dechet->setEcoPointsAttribues($points);

        // ✅ créditer le citoyen
        $citoyen = $dechet->getUser();
        if ($citoyen) {
            $citoyen->addEcoPoints($points);
        }

        $em->flush();

        // ✅ email automatique
        $mailer->sendDechetValide($dechet);

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
        if (!$this->isCsrfTokenValid('dechet_refuse_' . $dechet->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Action refusée (CSRF invalide).');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ déjà traité ?
        if ($dechet->getStatut() !== Dechet::STATUT_EN_ATTENTE) {
            $this->addFlash('warning', 'Cette déclaration a déjà été traitée.');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ statut + trace
        $dechet->setStatut(Dechet::STATUT_REFUSE);
        $dechet->setValidatedAt(new \DateTimeImmutable());
        $dechet->setValidatedBy($this->getUser());

        // ✅ pas de points
        $dechet->setEcoPointsAttribues(0);

        $em->flush();

        // ✅ email automatique
        $mailer->sendDechetRefuse($dechet);

        $this->addFlash('success', 'Déclaration refusée ❌ Email envoyé au citoyen.');
        return $this->redirectToRoute('app_dashboard_valorizateur');
    }
}
