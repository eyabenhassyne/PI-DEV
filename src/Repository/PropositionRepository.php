<?php

namespace App\Repository;

use App\Entity\Proposition;
use App\Entity\AppelOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PropositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proposition::class);
    }

    public function existsEmailForAppel(AppelOffre $appel, string $email): bool
    {
        $count = (int) $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->andWhere('p.appelOffre = :a')->setParameter('a', $appel)
            ->andWhere('p.email = :e')->setParameter('e', $email)
            ->getQuery()
            ->getSingleScalarResult();

        return $count > 0;
    }
}
