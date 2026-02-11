<?php

namespace App\Controller;

use App\Entity\EchangeRecompense;
use App\Entity\Recompense;
use App\Repository\EchangeRecompenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/citoyen/recompenses')]
class CitoyenRecompenseController extends AbstractController
{
    #[Route('/', name: 'app_citoyen_recompenses', methods: ['GET'])]
    public function index(): Response
    {
        // Tu as déjà ce rendu dans ton projet (liste recompenses + ecoPoints)
        // -> garde ton code actuel ici
        return $this->redirectToRoute('app_dashboard_citoyen');
    }

    #[Route('/{id}/echanger', name: 'citoyen_recompense_echanger', methods: ['POST'])]
    public function echanger(
        Recompense $recompense,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$this->isCsrfTokenValid('echanger_recompense_' . $recompense->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_citoyen_recompenses');
        }

        $user = $this->getUser();
        if (!$user || !method_exists($user, 'getEcoPoints') || !method_exists($user, 'setEcoPoints')) {
            $this->addFlash('error', 'Impossible de récupérer les EcoPoints.');
            return $this->redirectToRoute('app_citoyen_recompenses');
        }

        $ecoPoints = (int) $user->getEcoPoints();

        // ✅ stock
        if ((int) $recompense->getStock() <= 0) {
            $this->addFlash('warning', 'Stock épuisé.');
            return $this->redirectToRoute('app_citoyen_recompenses');
        }

        // ✅ points suffisants
        $need = (int) $recompense->getPointsNecessaires();
        if ($ecoPoints < $need) {
            $this->addFlash('error', "Pas assez de points. Il faut $need pts.");
            return $this->redirectToRoute('app_citoyen_recompenses');
        }

        // ✅ appliquer échange
        $user->setEcoPoints($ecoPoints - $need);
        $recompense->setStock((int) $recompense->getStock() - 1);

        // ✅ enregistrer l’échange (récompense acquise)
        $e = new EchangeRecompense();
        $e->setUser($user);
        $e->setRecompense($recompense);
        $e->setPointsUtilises($need);

        $em->persist($e);
        $em->flush();

        $this->addFlash('success', 'Échange effectué ✅ Récompense ajoutée à ta liste.');
        return $this->redirectToRoute('app_citoyen_recompenses_acquises');
    }

    #[Route('/acquises', name: 'app_citoyen_recompenses_acquises', methods: ['GET'])]
    public function acquises(EchangeRecompenseRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        $items = $repo->findByUser($user);

        return $this->render('citoyen/recompenses_acquises.html.twig', [
            'items' => $items,
        ]);
    }
}
