<?php

namespace App\Controller;

use App\Repository\CampagneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CampagneCitoyenController extends AbstractController
{
    #[Route('/dashboard/citoyen/campagnes', name: 'app_citoyen_campagnes', methods: ['GET'])]
    public function index(CampagneRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        // Tu peux choisir: findActive() ou findRunning() selon ton besoin
        $campagnes = $repo->findActive();

        return $this->render('citoyen/campagnes.html.twig', [
            'campagnes' => $campagnes,
        ]);
    }
}
