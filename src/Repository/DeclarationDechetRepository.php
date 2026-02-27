<?php

namespace App\Repository;

use App\Entity\DeclarationDechet;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DeclarationDechet>
 */
class DeclarationDechetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeclarationDechet::class);
    }

    /**
     * @return DeclarationDechet[]
     */
    public function findPendingOrderedDesc(): array
    {
        return $this->createQueryBuilder('d')
            ->where('d.statut = :pending')
            ->setParameter('pending', DeclarationDechet::STATUT_EN_ATTENTE)
            ->orderBy('d.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function countApprovedByCitoyen(User $citoyen): int
    {
        return (int) $this->createQueryBuilder('d')
            ->select('COUNT(d.id)')
            ->where('d.citoyen = :citoyen')
            ->andWhere('d.statut = :approved')
            ->setParameter('citoyen', $citoyen)
            ->setParameter('approved', DeclarationDechet::STATUT_APPROUVEE)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
