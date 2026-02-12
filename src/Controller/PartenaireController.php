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
}
