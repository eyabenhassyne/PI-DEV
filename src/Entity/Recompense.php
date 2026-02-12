<?php

namespace App\Entity;

use App\Repository\RecompenseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecompenseRepository::class)]
class Recompense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 140)]
    private string $titre = '';

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private int $pointsNecessaires = 0;

    #[ORM\Column]
    private int $stock = 0;

    #[ORM\ManyToOne(inversedBy: 'recompenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partenaire $partenaire = null;

    public function getId(): ?int { return $this->id; }

    public function getTitre(): string { return $this->titre; }
    public function setTitre(string $titre): self { $this->titre = $titre; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getPointsNecessaires(): int { return $this->pointsNecessaires; }
    public function setPointsNecessaires(int $points): self { $this->pointsNecessaires = $points; return $this; }

    public function getStock(): int { return $this->stock; }
    public function setStock(int $stock): self { $this->stock = $stock; return $this; }

    public function getPartenaire(): ?Partenaire { return $this->partenaire; }
    public function setPartenaire(?Partenaire $partenaire): self { $this->partenaire = $partenaire; return $this; }
}
