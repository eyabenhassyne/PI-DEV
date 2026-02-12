<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValorisateurController extends AbstractController
{
    #[Route('/valorisateur/dashboard', name: 'valorisateur_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('valorisateur/dashboard.html.twig');
    }
}
