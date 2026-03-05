<?php

namespace App\Repository;

use App\Entity\ReponseOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReponseOffre>
 */
class ReponseOffreRepository extends ServiceEntityRepository
{
    private const SORT_FIELDS = [
        'quantiteProposee' => 'r.quantiteProposee',
        'dateSoumis' => 'r.dateSoumis',
        'statut' => 'r.statut',
        'message' => 'r.message',
    ];

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReponseOffre::class);
    }

    /**
     * @param array{statut?:string|null, quantite_min?:float|null} $filters
     * @return ReponseOffre[]
     */
    public function searchAndSort(?string $query, string $sort, string $direction, array $filters = []): array
    {
        $sortField = self::SORT_FIELDS[$sort] ?? self::SORT_FIELDS['dateSoumis'];
        $sortDirection = strtoupper($direction) === 'ASC' ? 'ASC' : 'DESC';

        $qb = $this->createQueryBuilder('r')
            ->orderBy($sortField, $sortDirection);

        $normalizedQuery = trim((string) $query);
        if ($normalizedQuery !== '') {
            $qb
                ->andWhere('r.statut LIKE :query OR r.message LIKE :query')
                ->setParameter('query', '%'.$normalizedQuery.'%');
        }

        if (isset($filters['statut'])) {
            $normalizedStatus = mb_strtolower(trim(str_replace('_', ' ', (string) $filters['statut'])));

            if ($normalizedStatus === 'valide') {
                $statusValues = ['valide', 'validee'];
            } elseif ($normalizedStatus === 'refuse') {
                $statusValues = ['refuse', 'refusee', 'rejete', 'rejetee'];
            } else {
                $statusValues = ['en attente', 'pending'];
            }

            $qb
                ->andWhere('LOWER(r.statut) IN (:statutFilter)')
                ->setParameter('statutFilter', $statusValues);
        }

        if (isset($filters['quantite_min'])) {
            $qb
                ->andWhere('r.quantiteProposee >= :quantiteMin')
                ->setParameter('quantiteMin', (float) $filters['quantite_min']);
        }

        return $qb->getQuery()->getResult();
    }

    public function countPendingOlderThan(\DateTimeInterface $before): int
    {
        return (int) $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->andWhere('LOWER(r.statut) IN (:pending)')
            ->andWhere('r.dateSoumis <= :before')
            ->setParameter('pending', ['en attente', 'pending'])
            ->setParameter('before', $before)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countCreatedBetween(\DateTimeInterface $start, \DateTimeInterface $end): int
    {
        return (int) $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->andWhere('r.dateSoumis >= :start')
            ->andWhere('r.dateSoumis <= :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countRejectedBetween(\DateTimeInterface $start, \DateTimeInterface $end): int
    {
        return (int) $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->andWhere('LOWER(r.statut) IN (:rejected)')
            ->andWhere('r.dateSoumis >= :start')
            ->andWhere('r.dateSoumis <= :end')
            ->setParameter('rejected', ['refuse', 'refusee', 'rejete', 'rejetee'])
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return array{valide:int,en_attente:int,refuse:int,autre:int}
     */
    public function getStatusDistributionBetween(\DateTimeInterface $start, \DateTimeInterface $end): array
    {
        $rows = $this->getEntityManager()->getConnection()->executeQuery(
            'SELECT LOWER(REPLACE(statut, "_", " ")) AS status_key, COUNT(*) AS total
             FROM reponse_offre
             WHERE date_soumis BETWEEN :start AND :end
             GROUP BY status_key',
            [
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
            ]
        )->fetchAllAssociative();

        $distribution = [
            'valide' => 0,
            'en_attente' => 0,
            'refuse' => 0,
            'autre' => 0,
        ];

        foreach ($rows as $row) {
            $status = (string) ($row['status_key'] ?? '');
            $count = (int) ($row['total'] ?? 0);

            if (in_array($status, ['valide', 'validee'], true)) {
                $distribution['valide'] += $count;
            } elseif (in_array($status, ['en attente', 'pending'], true)) {
                $distribution['en_attente'] += $count;
            } elseif (in_array($status, ['refuse', 'refusee', 'rejete', 'rejetee'], true)) {
                $distribution['refuse'] += $count;
            } else {
                $distribution['autre'] += $count;
            }
        }

        return $distribution;
    }

    /**
     * @return array<string,int>
     */
    public function getDailyResponseCountsBetween(\DateTimeInterface $start, \DateTimeInterface $end): array
    {
        $rows = $this->getEntityManager()->getConnection()->executeQuery(
            'SELECT DATE(date_soumis) AS day_key, COUNT(*) AS total
             FROM reponse_offre
             WHERE date_soumis BETWEEN :start AND :end
             GROUP BY day_key
             ORDER BY day_key ASC',
            [
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
            ]
        )->fetchAllAssociative();

        $result = [];
        foreach ($rows as $row) {
            $result[(string) $row['day_key']] = (int) $row['total'];
        }

        return $result;
    }

    /**
     * @return array<string,float>
     */
    public function getDailyQuantitySumsBetween(\DateTimeInterface $start, \DateTimeInterface $end): array
    {
        $rows = $this->getEntityManager()->getConnection()->executeQuery(
            'SELECT DATE(date_soumis) AS day_key, COALESCE(SUM(quantite_proposee), 0) AS total_qty
             FROM reponse_offre
             WHERE date_soumis BETWEEN :start AND :end
             GROUP BY day_key
             ORDER BY day_key ASC',
            [
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
            ]
        )->fetchAllAssociative();

        $result = [];
        foreach ($rows as $row) {
            $result[(string) $row['day_key']] = (float) $row['total_qty'];
        }

        return $result;
    }

    /**
     * @return array<array{titre:string,total:int}>
     */
    public function getTopOffersByResponsesBetween(\DateTimeInterface $start, \DateTimeInterface $end, int $limit = 6): array
    {
        $rows = $this->getEntityManager()->getConnection()->executeQuery(
            'SELECT a.titre, COUNT(r.id) AS total
             FROM reponse_offre r
             INNER JOIN appel_offre a ON a.id = r.appel_offre_id
             WHERE r.date_soumis BETWEEN :start AND :end
             GROUP BY a.id, a.titre
             ORDER BY total DESC, a.id ASC
             LIMIT '.$limit,
            [
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
            ]
        )->fetchAllAssociative();

        return array_map(
            static fn (array $row): array => [
                'titre' => (string) ($row['titre'] ?? '-'),
                'total' => (int) ($row['total'] ?? 0),
            ],
            $rows
        );
    }

}
