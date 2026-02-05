<?php

namespace App\Controller;

use App\Repository\DechetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(DechetRepository $dechetRepo): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // 1) EcoPoints (à adapter selon ton User)
        $ecoPoints = method_exists($user, 'getEcoPoints') ? (int) $user->getEcoPoints() : 0;

        // 2) Stats déclarations
        $total = $dechetRepo->countByUser($user);
        $enAttente = $dechetRepo->countByUserAndStatus($user, 'EN_ATTENTE');
        $valides = $dechetRepo->countByUserAndStatus($user, 'VALIDE');
        $refuses = $dechetRepo->countByUserAndStatus($user, 'REFUSE');

        // 3) Badge (simple règle)
        $badge = match (true) {
            $ecoPoints >= 2000 => 'Eco-Légende',
            $ecoPoints >= 1000 => 'Eco-Héros',
            $ecoPoints >= 500  => 'Eco-Actif',
            default            => 'Débutant',
        };

        // 4) Activité récente
        $recent = $dechetRepo->findRecentByUser($user, 5);

        return $this->render('dashboard/index.html.twig', [
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
}
