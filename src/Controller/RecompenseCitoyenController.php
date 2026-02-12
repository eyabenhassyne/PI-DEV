<?php

namespace App\Controller;

use App\Repository\RecompenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecompenseCitoyenController extends AbstractController
{
    #[Route('/dashboard/citoyen/recompenses', name: 'app_citoyen_recompenses', methods: ['GET'])]
    public function index(RecompenseRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $recompenses = $repo->findDisponibles();

        $user = $this->getUser();
        $ecoPoints = method_exists($user, 'getEcoPoints') ? (int) $user->getEcoPoints() : 0;

        return $this->render('citoyen/recompenses.html.twig', [
            'recompenses' => $recompenses,
            'ecoPoints' => $ecoPoints,
        ]);
    }
}
