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

    /**
     * ✅ Historique valorisateur (VALIDÉ / REFUSÉ) avec filtres + pagination
     */
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
        $items = iterator_to_array($paginator);

        return [
            'items' => $items,
            'total' => $total,
            'page'  => $page,
            'limit' => $limit,
            'pages' => (int) ceil($total / $limit),
        ];
    }
}
