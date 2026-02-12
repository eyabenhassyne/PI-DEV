<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CitoyenController extends AbstractController
{
    #[Route('/citoyen/dashboard', name: 'citoyen_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('citoyen/dashboard.html.twig');
    }

    #[Route('/citoyen/declarations', name: 'citoyen_declarations')]
    public function declarations(): Response
    {
        // page placeholder pour le moment
        return new Response("Page Mes déclarations (à faire)");
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
