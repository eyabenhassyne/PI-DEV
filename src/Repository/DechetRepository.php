<?php

namespace App\Repository;

use App\Entity\Dechet;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class DechetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dechet::class);
    }

    // =========================================================
    // ✅ DASHBOARD CITOYEN (stats + activité récente)
    // =========================================================

    public function countByUser(User $user): int
    {
        return (int) $this->createQueryBuilder('d')
            ->select('COUNT(d.id)')
            ->andWhere('d.user = :u')
            ->setParameter('u', $user)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByUserAndStatus(User $user, string $status): int
    {
        return (int) $this->createQueryBuilder('d')
            ->select('COUNT(d.id)')
            ->andWhere('d.user = :u')
            ->andWhere('d.statut = :s')
            ->setParameter('u', $user)
            ->setParameter('s', $status)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findRecentByUser(User $user, int $limit = 5): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.user = :u')
            ->setParameter('u', $user)
            ->orderBy('d.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    // =========================================================
    // ✅ PAGE "MES DECLARATIONS" (liste + filtres + pagination)
    // =========================================================

    public function paginateByUser(
        User $user,
        ?string $type,
        ?string $statut,
        ?\DateTimeInterface $dateFrom,
        ?\DateTimeInterface $dateTo,
        int $page = 1,
        int $limit = 10
    ): array {
        $qb = $this->createQueryBuilder('d')
            ->andWhere('d.user = :u')
            ->setParameter('u', $user)
            ->orderBy('d.createdAt', 'DESC');

        if ($type) {
            $qb->andWhere('d.type LIKE :type')
                ->setParameter('type', '%' . $type . '%');
        }

        if ($statut && in_array($statut, [
            Dechet::STATUT_EN_ATTENTE,
            Dechet::STATUT_VALIDE,
            Dechet::STATUT_REFUSE,
        ], true)) {
            $qb->andWhere('d.statut = :s')
                ->setParameter('s', $statut);
        }

        if ($dateFrom) {
            $qb->andWhere('d.createdAt >= :df')
                ->setParameter('df', $dateFrom);
        }

        if ($dateTo) {
            $dateToEnd = (clone $dateTo)->setTime(23, 59, 59);
            $qb->andWhere('d.createdAt <= :dt')
                ->setParameter('dt', $dateToEnd);
        }

        $offset = max(0, ($page - 1) * $limit);
        $qb->setFirstResult($offset)->setMaxResults($limit);

        $paginator = new Paginator($qb, true);
        $total = count($paginator);

        return [
            'items' => iterator_to_array($paginator),
            'total' => $total,
            'page'  => $page,
            'limit' => $limit,
            'pages' => (int) ceil($total / $limit),
        ];
    }

    // =========================================================
    // ✅ IMPACT ENVIRONNEMENTAL (stats avancées)
    // =========================================================

    public function sumKgValideByUser(User $user): float
    {
        return (float) $this->createQueryBuilder('d')
            ->select('COALESCE(SUM(d.quantiteKg), 0)')
            ->andWhere('d.user = :u')
            ->andWhere('d.statut = :s')
            ->setParameter('u', $user)
            ->setParameter('s', Dechet::STATUT_VALIDE)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function kgValideByType(User $user): array
    {
        return $this->createQueryBuilder('d')
            ->select('d.type AS type, COALESCE(SUM(d.quantiteKg), 0) AS kg')
            ->andWhere('d.user = :u')
            ->andWhere('d.statut = :s')
            ->setParameter('u', $user)
            ->setParameter('s', Dechet::STATUT_VALIDE)
            ->groupBy('d.type')
            ->orderBy('kg', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }

    public function monthlyKgValide(User $user, int $monthsBack = 6): array
    {
        $monthsBack = max(1, $monthsBack);

        $from = (new \DateTimeImmutable('first day of this month 00:00:00'))
            ->modify('-' . ($monthsBack - 1) . ' months')
            ->format('Y-m-d H:i:s');

        $conn = $this->getEntityManager()->getConnection();

        $sql = "
            SELECT 
                DATE_FORMAT(d.created_at, '%Y-%m') AS month,
                COALESCE(SUM(d.quantite_kg), 0) AS kg
            FROM dechet d
            WHERE d.user_id = :userId
              AND d.statut = :statut
              AND d.created_at >= :fromDate
            GROUP BY month
            ORDER BY month ASC
        ";

        return $conn->executeQuery($sql, [
            'userId'   => $user->getId(),
            'statut'   => Dechet::STATUT_VALIDE,
            'fromDate' => $from,
        ])->fetchAllAssociative();
    }

    // =========================================================
    // ✅ HISTORIQUE VALORISATEUR (VALIDÉ / REFUSÉ)
    // =========================================================

    public function paginateHistoriqueValorisateur(
        ?string $type,
        ?string $statut,
        ?\DateTimeInterface $dateFrom,
        ?\DateTimeInterface $dateTo,
        int $page = 1,
        int $limit = 10
    ): array {
        $qb = $this->createQueryBuilder('d')
            ->leftJoin('d.user', 'u')->addSelect('u')
            ->andWhere('d.statut IN (:treated)')
            ->setParameter('treated', [Dechet::STATUT_VALIDE, Dechet::STATUT_REFUSE])
            ->orderBy('d.createdAt', 'DESC');

        if ($type) {
            $qb->andWhere('d.type LIKE :type')
                ->setParameter('type', '%' . $type . '%');
        }

        if ($statut && in_array($statut, [Dechet::STATUT_VALIDE, Dechet::STATUT_REFUSE], true)) {
            $qb->andWhere('d.statut = :statut')
                ->setParameter('statut', $statut);
        }

        if ($dateFrom) {
            $qb->andWhere('d.createdAt >= :df')
                ->setParameter('df', $dateFrom);
        }

        if ($dateTo) {
            $dateToEnd = (clone $dateTo)->setTime(23, 59, 59);
            $qb->andWhere('d.createdAt <= :dt')
                ->setParameter('dt', $dateToEnd);
        }

        $offset = max(0, ($page - 1) * $limit);
        $qb->setFirstResult($offset)->setMaxResults($limit);

        $paginator = new Paginator($qb, true);
        $total = count($paginator);

        return [
            'items' => iterator_to_array($paginator),
            'total' => $total,
            'page'  => $page,
            'limit' => $limit,
            'pages' => (int) ceil($total / $limit),
        ];
    }

    // =========================================================
    // ✅ NOUVEAU : MAP CITOYEN (SES POINTS)
    // =========================================================
    public function findForMapByUser(User $user): array
    {
        return $this->createQueryBuilder('d')
            ->select('d.id, d.latitude, d.longitude, d.statut, d.type, d.quantiteKg, d.adresse, d.createdAt')
            ->andWhere('d.user = :u')
            ->setParameter('u', $user)
            ->andWhere('d.latitude IS NOT NULL')
            ->andWhere('d.longitude IS NOT NULL')
            ->orderBy('d.createdAt', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }
}
