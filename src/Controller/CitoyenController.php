<?php

namespace App\Controller;

use App\Entity\DeclarationDechet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CitoyenController extends AbstractController
{
    #[Route('/citoyen/dashboard', name: 'citoyen_dashboard')]
    public function dashboard(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(DeclarationDechet::class);
        
        $stats = [
            'total' => $repo->count([]),
            'valide' => $repo->count(['statut' => 'valide']),
            'en_attente' => $repo->count(['statut' => 'en_attente']),
            'points' => $repo->count(['statut' => 'valide']) * 20, // Exemple simple : 20 points par déclaration validée
        ];

        return $this->render('citoyen/dashboard.html.twig', [
            'stats' => $stats
        ]);
    }

    #[Route('/citoyen/statistiques', name: 'citoyen_statistiques')]
    public function statistiques(): Response
    {
        return new Response("Page Statistiques (à faire)");
    }

    #[Route('/citoyen/parametres', name: 'citoyen_parametres')]
    public function parametres(): Response
    {
        return new Response("Page Paramètres (à faire)");
    }
}
