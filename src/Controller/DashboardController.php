<?php

namespace App\Controller;

use App\Entity\Dechet;
use App\Repository\DechetRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    /**
     * ✅ HUB: redirige automatiquement vers le bon dashboard selon le rôle
     */
    #[Route('/dashboard', name: 'app_dashboard', methods: ['GET'])]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_dashboard_admin');
        }

        if ($this->isGranted('ROLE_VALORIZER')) {
            return $this->redirectToRoute('app_dashboard_valorizateur');
        }

        // Citoyen (ou Partner si tu veux plus tard)
        return $this->redirectToRoute('app_dashboard_citoyen');
    }

    /**
     * ✅ Dashboard Citoyen réel
     */
    #[Route('/dashboard/citoyen', name: 'app_dashboard_citoyen', methods: ['GET'])]
    public function citoyen(DechetRepository $dechetRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();

        // Stats du citoyen (ses propres déclarations)
        $total = $dechetRepo->count(['user' => $user]);
        $enAttente = $dechetRepo->count(['user' => $user, 'statut' => Dechet::STATUT_EN_ATTENTE]);
        $valides = $dechetRepo->count(['user' => $user, 'statut' => Dechet::STATUT_VALIDE]);
        $refuses = $dechetRepo->count(['user' => $user, 'statut' => Dechet::STATUT_REFUSE]);

        $recent = $dechetRepo->findBy(['user' => $user], ['createdAt' => 'DESC'], 5);

        $ecoPoints = method_exists($user, 'getEcoPoints') ? (int) $user->getEcoPoints() : 0;

        $badge = $ecoPoints >= 2000 ? 'Expert'
            : ($ecoPoints >= 1000 ? 'Or'
            : ($ecoPoints >= 500 ? 'Argent' : 'Débutant'));

        return $this->render('dashboard/citoyen.html.twig', [
            'ecoPoints' => $ecoPoints,
            'badge' => $badge,
            'stats' => [
                'total' => $total,
                'enAttente' => $enAttente,
                'valides' => $valides,
                'refuses' => $refuses,
            ],
            'recent' => $recent,
        ]);
    }

    /**
     * ✅ Dashboard Admin
     */
 #[Route('/dashboard/admin', name: 'app_dashboard_admin', methods: ['GET'])]
public function admin(UserRepository $userRepo, DechetRepository $dechetRepo): Response
{
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    return $this->render('dashboard/admin.html.twig', [
        'usersTotal'   => $userRepo->count([]),
        'dechetsTotal' => $dechetRepo->count([]),

        // ✅ AJOUTÉS (pour ton template)
        'valides'      => $dechetRepo->count(['statut' => Dechet::STATUT_VALIDE]),
        'refuses'      => $dechetRepo->count(['statut' => Dechet::STATUT_REFUSE]),

        'enAttente'    => $dechetRepo->count(['statut' => Dechet::STATUT_EN_ATTENTE]),
        'lastUsers'    => $userRepo->findBy([], ['createdAt' => 'DESC'], 5),
        'lastDechets'  => $dechetRepo->findBy([], ['createdAt' => 'DESC'], 5),
    ]);
}

    /**
     * ✅ Dashboard Valorisateur
     */
    #[Route('/dashboard/valorisateur', name: 'app_dashboard_valorizateur', methods: ['GET'])]
    public function valorisateur(DechetRepository $dechetRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        return $this->render('dashboard/valorisateur.html.twig', [
            'enAttente'      => $dechetRepo->findBy(
                ['statut' => Dechet::STATUT_EN_ATTENTE],
                ['createdAt' => 'DESC']
            ),
            'countEnAttente' => $dechetRepo->count(['statut' => Dechet::STATUT_EN_ATTENTE]),
            'countValide'    => $dechetRepo->count(['statut' => Dechet::STATUT_VALIDE]),
            'countRefuse'    => $dechetRepo->count(['statut' => Dechet::STATUT_REFUSE]),
        ]);
    }
}
