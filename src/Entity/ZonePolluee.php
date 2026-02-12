<?php

namespace App\Entity;

use App\Repository\ZonePollueeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZonePollueeRepository::class)]
class ZonePolluee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomZone = null;

    #[ORM\Column(length: 255)]
    private ?string $coordonneesGps = null;

    #[ORM\Column(type: "integer")]
    private ?int $niveauPollution = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateIdentification = null;

    #[ORM\ManyToOne(targetEntity: IndicateurImpact::class, inversedBy: "zonePolluees")]
    #[ORM\JoinColumn(name: "indicateur_id", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    private ?IndicateurImpact $indicateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomZone(): ?string
    {
        return $this->nomZone;
    }

    public function setNomZone(string $nomZone): static
    {
        $this->nomZone = $nomZone;
        return $this;
    }

    public function getCoordonneesGps(): ?string
    {
        return $this->coordonneesGps;
    }

    public function setCoordonneesGps(string $coordonneesGps): static
    {
        $this->coordonneesGps = $coordonneesGps;
        return $this;
    }

    public function getNiveauPollution(): ?int
    {
        return $this->niveauPollution;
    }

    public function setNiveauPollution(int $niveauPollution): static
    {
        $this->niveauPollution = $niveauPollution;
        return $this;
    }

    public function getDateIdentification(): ?\DateTimeInterface
    {
        return $this->dateIdentification;
    }

    public function setDateIdentification(?\DateTimeInterface $dateIdentification): static
    {
        $this->dateIdentification = $dateIdentification;
        return $this;
    }

    public function getIndicateur(): ?IndicateurImpact
    {
        return $this->indicateur;
    }

    public function setIndicateur(?IndicateurImpact $indicateur): static
    {
        $this->indicateur = $indicateur;
        return $this;
    }
}