<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Repository\ParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(EvenementRepository $evRepo, ParticipationRepository $partRepo): Response
    {
        return $this->render('dashboard/index.html.twig', [
            
            'totalEvents' => $evRepo->count([]), 
            'totalParticipations' => $partRepo->count([]),
            
            
            'evenements' => $evRepo->findAll(),
        ]);
    }
}