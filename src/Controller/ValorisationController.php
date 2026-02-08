<?php

namespace App\Controller;

use App\Entity\Dechet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ValorisationController extends AbstractController
{
    #[Route('/valorisateur/dechet/{id}/valider', name: 'val_dechet_valider', methods: ['POST'])]
    public function valider(Dechet $dechet, Request $request, EntityManagerInterface $em): RedirectResponse
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        // ✅ CSRF
        if (!$this->isCsrfTokenValid('dechet_validate_' . $dechet->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Action refusée (token CSRF invalide).');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ Déjà traité ?
        if ($dechet->getStatut() !== Dechet::STATUT_EN_ATTENTE) {
            $this->addFlash('warning', 'Cette déclaration a déjà été traitée.');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        $dechet->setStatut(Dechet::STATUT_VALIDE);
        $em->flush();

        $this->addFlash('success', 'Déclaration validée avec succès ✅');
        return $this->redirectToRoute('app_dashboard_valorizateur');
    }

    #[Route('/valorisateur/dechet/{id}/refuser', name: 'val_dechet_refuser', methods: ['POST'])]
    public function refuser(Dechet $dechet, Request $request, EntityManagerInterface $em): RedirectResponse
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        // ✅ CSRF
        if (!$this->isCsrfTokenValid('dechet_refuse_' . $dechet->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Action refusée (token CSRF invalide).');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // ✅ Déjà traité ?
        if ($dechet->getStatut() !== Dechet::STATUT_EN_ATTENTE) {
            $this->addFlash('warning', 'Cette déclaration a déjà été traitée.');
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        $dechet->setStatut(Dechet::STATUT_REFUSE);
        $em->flush();

        $this->addFlash('success', 'Déclaration refusée ❌');
        return $this->redirectToRoute('app_dashboard_valorizateur');
    }
}
