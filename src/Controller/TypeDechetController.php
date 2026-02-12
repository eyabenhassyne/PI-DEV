<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TypeDechetController extends AbstractController
{
    #[Route('/type/dechet', name: 'app_type_dechet')]
    public function index(): Response
    {
        return $this->render('type_dechet/index.html.twig', [
            'controller_name' => 'TypeDechetController',
        ]);
    }
}
