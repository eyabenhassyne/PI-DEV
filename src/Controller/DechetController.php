<?php

namespace App\Controller;

use App\Entity\Dechet;
use App\Form\DechetType;
use App\Repository\DechetRepository;
use App\Service\EcoPointsEstimator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DechetController extends AbstractController
{
    /**
     * ✅ Déclarer un déchet + estimation automatique
     */
    #[Route('dechet/nouveau', name: 'dechet_nouveau', methods: ['GET','POST'])]
    public function nouveau(
        Request $request,
        EntityManagerInterface $em,
        EcoPointsEstimator $estimator
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $dechet = new Dechet();
        $form = $this->createForm(DechetType::class, $dechet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ✅ Associer au user connecté
            $dechet->setUser($this->getUser());

            // ✅ Estimation provisoire
            $estimation = $estimator->estimate(
                (string) $dechet->getType(),
                (float)  $dechet->getQuantiteKg()
            );
            $dechet->setEstimationEcoPoints($estimation);

            $em->persist($dechet);
            $em->flush();

            $this->addFlash(
                'success',
                'Déchet déclaré ✅ Estimation provisoire : ' . $estimation . ' EcoPoints (en attente de validation).'
            );

            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('citoyen/dechet/nouveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * ✅ Mes déclarations (liste + filtres + pagination)
     */
    #[Route('/citoyen/declarations', name: 'citoyen_declarations', methods: ['GET'])]
    public function mesDeclarations(
        Request $request,
        DechetRepository $dechetRepo
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Filtres (GET)
        $type   = trim((string) $request->query->get('type', '')) ?: null;
        $statut = trim((string) $request->query->get('statut', '')) ?: null;

        $dateFromStr = trim((string) $request->query->get('dateFrom', '')) ?: null;
        $dateToStr   = trim((string) $request->query->get('dateTo', '')) ?: null;

        $dateFrom = $dateFromStr ? \DateTimeImmutable::createFromFormat('Y-m-d', $dateFromStr) : null;
        $dateTo   = $dateToStr ? \DateTimeImmutable::createFromFormat('Y-m-d', $dateToStr) : null;

        $page  = max(1, (int) $request->query->get('page', 1));
        $limit = 10;

        // ⚠️ nécessite la méthode paginateByUser() dans DechetRepository
        $pagination = $dechetRepo->paginateByUser(
            $user,
            $type,
            $statut,
            $dateFrom,
            $dateTo,
            $page,
            $limit
        );

        return $this->render('citoyen/declarations/index.html.twig', [
            'pagination' => $pagination,
            'filters' => [
                'type' => $type ?? '',
                'statut' => $statut ?? '',
                'dateFrom' => $dateFromStr ?? '',
                'dateTo' => $dateToStr ?? '',
            ],
            'statuts' => [
                Dechet::STATUT_EN_ATTENTE,
                Dechet::STATUT_VALIDE,
                Dechet::STATUT_REFUSE,
            ],
        ]);
    }

    /**
     * ✅ Impact environnemental (page dédiée)
     * - total kg validés
     * - kg par type
     * - évolution par mois
     */
    #[Route('/citoyen/impact', name: 'citoyen_impact', methods: ['GET'])]
    public function impact(
        DechetRepository $dechetRepo
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // ⚠️ nécessite sumKgValideByUser(), kgValideByType(), monthlyKgValide() dans DechetRepository
        $kgTotalValide = $dechetRepo->sumKgValideByUser($user);
        $kgByType      = $dechetRepo->kgValideByType($user);
        $monthly       = $dechetRepo->monthlyKgValide($user, 6);

        return $this->render('citoyen/impact/index.html.twig', [
            'impact' => [
                'kgTotalValide' => $kgTotalValide,
                'kgByType' => $kgByType,
                'monthly' => $monthly,
            ],
        ]);
    }
}
