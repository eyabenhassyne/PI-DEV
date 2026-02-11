<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
#[ORM\Table(name: 'participation')]
#[ORM\UniqueConstraint(name: 'uniq_user_campagne', columns: ['user_id', 'campagne_id'])]
class Participation
{
    public const STATUT_ACTIF = 'ACTIF';
    public const STATUT_QUITTE = 'QUITTE';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'participations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private ?Campagne $campagne = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private ?User $user = null;

    #[ORM\Column]
    private \DateTimeImmutable $joinedAt;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $leftAt = null;

    #[ORM\Column(length: 10)]
    #[Assert\Choice(choices: [self::STATUT_ACTIF, self::STATUT_QUITTE])]
    private string $statut = self::STATUT_ACTIF;

    public function __construct()
    {
        $this->joinedAt = new \DateTimeImmutable();
        $this->statut = self::STATUT_ACTIF;
    }

    public function getId(): ?int { return $this->id; }

    public function getCampagne(): ?Campagne { return $this->campagne; }
    public function setCampagne(?Campagne $campagne): self { $this->campagne = $campagne; return $this; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(?User $user): self { $this->user = $user; return $this; }

    public function getJoinedAt(): \DateTimeImmutable { return $this->joinedAt; }
    public function setJoinedAt(\DateTimeImmutable $joinedAt): self { $this->joinedAt = $joinedAt; return $this; }

    public function getLeftAt(): ?\DateTimeImmutable { return $this->leftAt; }
    public function setLeftAt(?\DateTimeImmutable $leftAt): self { $this->leftAt = $leftAt; return $this; }

    public function getStatut(): string { return $this->statut; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }
}
