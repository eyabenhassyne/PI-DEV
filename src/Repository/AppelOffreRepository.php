<?php

namespace App\Repository;

use App\Entity\AppelOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AppelOffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppelOffre::class);
    }

    public function searchForValorisateur(?string $q, string $sort = 'createdAt', string $dir = 'DESC'): array
    {
        $allowedSort = ['createdAt', 'dateFin', 'dateDebut', 'titre', 'statut'];
        if (!in_array($sort, $allowedSort, true)) $sort = 'createdAt';
        $dir = strtoupper($dir) === 'ASC' ? 'ASC' : 'DESC';

        $qb = $this->createQueryBuilder('a');

        if ($q) {
            $qb->andWhere('a.titre LIKE :q OR a.description LIKE :q')
               ->setParameter('q', '%'.$q.'%');
        }

        return $qb->orderBy('a.'.$sort, $dir)
                  ->getQuery()
                  ->getResult();
    }

  public function listOpenForCitoyen(?string $q): array
{
    $today = new \DateTimeImmutable('today');

    $qb = $this->createQueryBuilder('a')
        ->andWhere('a.statut = :s')->setParameter('s', 'PUBLIE')
        ->andWhere('a.dateFin >= :t')->setParameter('t', $today)
        // optionnel (recommandé) : ne montrer que si l’appel a commencé
        ->andWhere('a.dateDebut <= :t')->setParameter('t', $today)
        ->orderBy('a.dateFin', 'ASC');

    if ($q) {
        $qb->andWhere('a.titre LIKE :q OR a.description LIKE :q')
           ->setParameter('q', '%'.$q.'%');
    }

    return $qb->getQuery()->getResult();
}

}
