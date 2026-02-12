<?php

namespace App\Controller\Valorisateur;

use App\Entity\Proposition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/valorisateur/propositions')]
class PropositionController extends AbstractController
{
    #[Route('/{id}/accepter', name: 'val_prop_accepter', methods: ['POST'])]
    public function accepter(Request $request, Proposition $proposition, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        if ($this->isCsrfTokenValid('prop_action_'.$proposition->getId(), (string) $request->request->get('_token'))) {
            $proposition->setStatut('ACCEPTEE');
            $em->flush();
            $this->addFlash('success', "Proposition acceptée.");
        }

        return $this->redirectToRoute('val_appel_show', ['id' => $proposition->getAppelOffre()->getId()]);
    }

    #[Route('/{id}/refuser', name: 'val_prop_refuser', methods: ['POST'])]
    public function refuser(Request $request, Proposition $proposition, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        if ($this->isCsrfTokenValid('prop_action_'.$proposition->getId(), (string) $request->request->get('_token'))) {
            $proposition->setStatut('REFUSEE');
            $em->flush();
            $this->addFlash('success', "Proposition refusée.");
        }

        return $this->redirectToRoute('val_appel_show', ['id' => $proposition->getAppelOffre()->getId()]);
    }
}
