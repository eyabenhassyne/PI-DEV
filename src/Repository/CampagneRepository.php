<?php

namespace App\Repository;

use App\Entity\Campagne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CampagneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campagne::class);
    }

    /** ✅ Campagnes actives (statut = ACTIVE) */
    public function findActive(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.statut = :s')
            ->setParameter('s', 'ACTIVE')
            ->orderBy('c.dateDebut', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /** ✅ Campagnes en cours (ACTIVE + now entre début et fin, fin peut être NULL) */
    public function findRunning(?\DateTimeInterface $now = null): array
    {
        $now ??= new \DateTimeImmutable();

        return $this->createQueryBuilder('c')
            ->andWhere('c.statut = :s')
            ->setParameter('s', 'ACTIVE')
            ->andWhere('c.dateDebut <= :now')
            ->andWhere('(c.dateFin IS NULL OR c.dateFin >= :now)')
            ->setParameter('now', $now)
            ->orderBy('c.dateFin', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /** ✅ Campagnes à venir (ACTIVE + dateDebut > now) */
    public function findUpcoming(?\DateTimeInterface $now = null): array
    {
        $now ??= new \DateTimeImmutable();

        return $this->createQueryBuilder('c')
            ->andWhere('c.statut = :s')
            ->setParameter('s', 'ACTIVE')
            ->andWhere('c.dateDebut > :now')
            ->setParameter('now', $now)
            ->orderBy('c.dateDebut', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /** ✅ Dernières campagnes (admin) */
    public function findLatest(int $limit = 5): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
