<?php

namespace App\Controller;

use App\Entity\AppelOffre;
use App\Entity\ReponseOffre;
use App\Repository\AppelOffreRepository;
use App\Repository\ReponseOffreRepository;
use App\Service\AdminAlertService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_front_dashboard', methods: ['GET'])]
    public function front(ReponseOffreRepository $reponseOffreRepository): Response
    {
        $recentReponses = $reponseOffreRepository->findBy([], ['id' => 'DESC'], 6);

        $declarations = array_map(
            fn (ReponseOffre $reponse): array => [
                'date' => $reponse->getDateSoumis()?->format('d M') ?? '-',
                'type' => $reponse->getAppelOffre()?->getTitre() ?? 'Offre',
                'quantite' => ($reponse->getQuantiteProposee() ?? 0).' kg',
                'points' => $this->computeEcoPoints($reponse),
                'status' => $this->normalizeStatus($reponse->getStatut()),
            ],
            $recentReponses
        );

        $ecoPoints = array_reduce(
            $recentReponses,
            fn (int $total, ReponseOffre $reponse): int => $total + $this->computeEcoPoints($reponse),
            0
        );

        return $this->render('dashboard/front.html.twig', [
            'declarations' => $declarations,
            'recompenses' => [
                ['label' => 'Bon d\'achat Carrefour 10 DT', 'cout' => 800],
                ['label' => 'Reduction transport public', 'cout' => 600],
                ['label' => 'Cafe gratuit chez Ben Yedder', 'cout' => 500],
            ],
            'eco_points' => $ecoPoints,
        ]);
    }

    #[Route('/back/dashboard', name: 'app_back_dashboard', methods: ['GET'])]
    public function back(
        AppelOffreRepository $appelOffreRepository,
        ReponseOffreRepository $reponseOffreRepository,
        AdminAlertService $adminAlertService
    ): Response {
        $now = new \DateTimeImmutable();
        $in7Days = $now->modify('+7 days');
        $startLast7 = $now->modify('-7 days');
        $startPrev7 = $now->modify('-14 days');

        $allAppels = $appelOffreRepository->findAll();
        $recentAppels = $appelOffreRepository->findBy([], ['id' => 'DESC'], 5);
        $recentReponses = $reponseOffreRepository->findBy([], ['id' => 'DESC'], 5);
        $allReponses = $reponseOffreRepository->findAll();

        $totalAppels = count($allAppels);
        $offresExpirees = array_reduce(
            $allAppels,
            fn (int $total, AppelOffre $appel): int => $total + ($appel->isExpired($now) ? 1 : 0),
            0
        );
        $offresActives = max(0, $totalAppels - $offresExpirees);
        $offresExpirentBientot = array_reduce(
            $allAppels,
            function (int $total, AppelOffre $appel) use ($now, $in7Days): int {
                $dateLimite = $appel->getDateLimite();

                if (!$dateLimite || $appel->isExpired($now)) {
                    return $total;
                }

                return $total + (($dateLimite <= $in7Days) ? 1 : 0);
            },
            0
        );

        $totalReponses = count($allReponses);
        $totalEnAttente = $this->countByStatuses($allReponses, ['en attente', 'en_attente', 'pending']);
        $totalValidees = $this->countByStatuses($allReponses, ['valide', 'validee']);
        $totalRefusees = $this->countByStatuses($allReponses, ['refuse', 'refusee', 'rejete', 'rejetee']);

        $tauxValidation = $totalReponses > 0
            ? (int) round(($totalValidees / $totalReponses) * 100)
            : 0;

        $reponsesLast7 = $this->countSubmittedBetween($allReponses, $startLast7, $now);
        $reponsesPrev7 = $this->countSubmittedBetween($allReponses, $startPrev7, $startLast7);
        $trendReponsesPct = $reponsesPrev7 > 0
            ? (int) round((($reponsesLast7 - $reponsesPrev7) / $reponsesPrev7) * 100)
            : ($reponsesLast7 > 0 ? 100 : 0);

        $backlogRate = $totalReponses > 0
            ? (int) round(($totalEnAttente / $totalReponses) * 100)
            : 0;

        $healthIndex = (int) round(
            max(0, min(100, (0.45 * $tauxValidation) + (0.35 * (100 - $backlogRate)) + (0.20 * max(0, 100 - ($offresExpirees * 5)))))
        );
        $alertCenter = $adminAlertService->buildAlertCenter($now);

        return $this->render('dashboard/back.html.twig', [
            'kpis' => [
                'total_appels' => $totalAppels,
                'offres_actives' => $offresActives,
                'offres_expirees' => $offresExpirees,
                'offres_expirent_bientot' => $offresExpirentBientot,
                'reponses_recues' => $totalReponses,
                'reponses_validees' => $totalValidees,
                'reponses_en_attente' => $totalEnAttente,
                'reponses_refusees' => $totalRefusees,
                'taux_validation' => $tauxValidation,
                'backlog_rate' => $backlogRate,
                'health_index' => $healthIndex,
                'reponses_last7' => $reponsesLast7,
                'trend_reponses_pct' => $trendReponsesPct,
            ],
            'recent_appels' => array_map(
                function (AppelOffre $appel) use ($now): array {
                    $dateLimite = $appel->getDateLimite();
                    $daysLeft = null;
                    if ($dateLimite !== null) {
                        $daysLeft = (int) $now->diff($dateLimite)->format('%r%a');
                    }

                    return [
                        'titre' => $appel->getTitre() ?? '-',
                        'quantite' => ($appel->getQuantiteDemandee() ?? 0).' kg',
                        'date_limite' => $dateLimite?->format('Y-m-d') ?? '-',
                        'est_expire' => $appel->isExpired($now),
                        'days_left' => $daysLeft,
                    ];
                },
                $recentAppels
            ),
            'recent_reponses' => array_map(
                fn (ReponseOffre $reponse): array => [
                    'citoyen' => trim(
                        ($reponse->getCitoyen()?->getPrenom() ?? '').' '.($reponse->getCitoyen()?->getNom() ?? '')
                    ) ?: 'Citoyen',
                    'offre' => $reponse->getAppelOffre()?->getTitre() ?? 'Offre',
                    'statut' => $this->normalizeStatus($reponse->getStatut()),
                ],
                $recentReponses
            ),
            'status_distribution' => [
                'validees' => $totalValidees,
                'en_attente' => $totalEnAttente,
                'refusees' => $totalRefusees,
            ],
            'alert_center' => $alertCenter,
        ]);
    }

    private function countSubmittedBetween(array $reponses, \DateTimeImmutable $from, \DateTimeImmutable $to): int
    {
        return array_reduce(
            $reponses,
            function (int $total, ReponseOffre $reponse) use ($from, $to): int {
                $date = $reponse->getDateSoumis();
                if (!$date) {
                    return $total;
                }

                return $total + (($date >= $from && $date <= $to) ? 1 : 0);
            },
            0
        );
    }

    private function countByStatuses(array $reponses, array $statuses): int
    {
        $normalizedStatuses = array_map(
            fn (string $status): string => strtolower(trim(str_replace('_', ' ', $status))),
            $statuses
        );

        return array_reduce(
            $reponses,
            function (int $total, ReponseOffre $reponse) use ($normalizedStatuses): int {
                $status = strtolower(trim(str_replace('_', ' ', $reponse->getStatut() ?? '')));

                return $total + (in_array($status, $normalizedStatuses, true) ? 1 : 0);
            },
            0
        );
    }

    private function normalizeStatus(?string $status): string
    {
        $normalized = strtolower(trim(str_replace('_', ' ', $status ?? '')));

        if (in_array($normalized, ['valide', 'validee'], true)) {
            return 'valide';
        }

        if (in_array($normalized, ['en attente', 'pending'], true)) {
            return 'en attente';
        }

        return $normalized !== '' ? $normalized : 'en attente';
    }

    private function computeEcoPoints(ReponseOffre $reponse): int
    {
        $base = (int) round(($reponse->getQuantiteProposee() ?? 0) * 10);

        return $this->normalizeStatus($reponse->getStatut()) === 'valide'
            ? $base
            : (int) round($base * 0.5);
    }
}
