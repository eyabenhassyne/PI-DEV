<?php

namespace App\Repository;

use App\Entity\Dechet;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
}
