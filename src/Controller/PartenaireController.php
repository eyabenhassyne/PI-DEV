<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireController extends AbstractController
{
    #[Route('/partenaire/dashboard', name: 'partenaire_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('partenaire/dashboard.html.twig');
    }

    #[Route('/partenaire/collectes', name: 'partenaire_collectes')]
    public function collectes(): Response
    {
        return $this->render('partenaire/collectes.html.twig');
    }

    #[Route('/partenaire/zones', name: 'partenaire_zones')]
    public function zones(): Response
    {
        return $this->render('partenaire/zones.html.twig');
    }

    #[Route('/partenaire/planning', name: 'partenaire_planning')]
    public function planning(): Response
    {
        return $this->render('partenaire/planning.html.twig');
    }

    #[Route('/partenaire/parametres', name: 'partenaire_parametres')]
    public function parametres(): Response
    {
        return $this->render('partenaire/parametres.html.twig');
    }
}
