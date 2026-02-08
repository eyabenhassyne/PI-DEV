<?php

namespace App\Controller;

use App\Entity\Dechet;
use App\Repository\DechetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HistoriqueValorisateurController extends AbstractController
{
    #[Route('/dashboard/valorisateur/historique', name: 'app_valorizateur_historique', methods: ['GET'])]
    public function historique(Request $request, DechetRepository $dechetRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VALORIZER');

        $type   = trim((string) $request->query->get('type', '')) ?: null;
        $statut = (string) $request->query->get('statut', '');
        $statut = $statut ?: null;

        $dateFrom = $request->query->get('dateFrom') ? new \DateTime($request->query->get('dateFrom')) : null;
        $dateTo   = $request->query->get('dateTo') ? new \DateTime($request->query->get('dateTo')) : null;

        $page  = max(1, (int) $request->query->get('page', 1));
        $limit = (int) $request->query->get('limit', 10);
        $limit = in_array($limit, [5,10,20,50], true) ? $limit : 10;

        $data = $dechetRepo->paginateHistoriqueValorisateur(
            $type,
            $statut,
            $dateFrom,
            $dateTo,
            $page,
            $limit
        );

        return $this->render('dashboard/valorisateur_historique.html.twig', [
            'items' => $data['items'],
            'total' => $data['total'],
            'page'  => $data['page'],
            'pages' => $data['pages'],
            'limit' => $data['limit'],

            // pour garder les filtres dans le formulaire / pagination
            'filters' => [
                'type' => $type ?? '',
                'statut' => $statut ?? '',
                'dateFrom' => $request->query->get('dateFrom', ''),
                'dateTo' => $request->query->get('dateTo', ''),
            ],

            'STATUT_VALIDE' => Dechet::STATUT_VALIDE,
            'STATUT_REFUSE' => Dechet::STATUT_REFUSE,
        ]);
    }
}
