<?php

namespace App\Entity;

use App\Repository\EchangeRecompenseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EchangeRecompenseRepository::class)]
class EchangeRecompense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'echangesRecompenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recompense $recompense = null;

    #[ORM\Column]
    private int $pointsUtilises = 0;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(User $user): self { $this->user = $user; return $this; }

    public function getRecompense(): ?Recompense { return $this->recompense; }
    public function setRecompense(Recompense $recompense): self { $this->recompense = $recompense; return $this; }

    public function getPointsUtilises(): int { return $this->pointsUtilises; }
    public function setPointsUtilises(int $points): self { $this->pointsUtilises = $points; return $this; }

    public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(\DateTimeImmutable $dt): self { $this->createdAt = $dt; return $this; }
}
    