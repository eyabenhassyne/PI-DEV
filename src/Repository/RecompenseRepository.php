<?php

namespace App\Repository;

use App\Entity\Recompense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RecompenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recompense::class);
    }

    /** @return Recompense[] */
    public function findAllWithPartenaire(): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.partenaire', 'p')->addSelect('p')
            ->orderBy('r.id', 'DESC')
            ->getQuery()->getResult();
    }

    /** ✅ Récompenses disponibles (stock > 0) */
    public function findDisponibles(): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.partenaire', 'p')->addSelect('p')
            ->andWhere('r.stock > 0')
            ->orderBy('r.pointsNecessaires', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /** ✅ Optionnel : recherche par titre + seulement disponibles */
    public function searchDisponibles(?string $q): array
    {
        $qb = $this->createQueryBuilder('r')
            ->leftJoin('r.partenaire', 'p')->addSelect('p')
            ->andWhere('r.stock > 0');

        if ($q && trim($q) !== '') {
            $qb->andWhere('LOWER(r.titre) LIKE :q OR LOWER(r.description) LIKE :q OR LOWER(p.nomEntreprise) LIKE :q')
               ->setParameter('q', '%'.mb_strtolower(trim($q)).'%');
        }

        return $qb->orderBy('r.pointsNecessaires', 'ASC')
                  ->getQuery()
                  ->getResult();
    }
}
