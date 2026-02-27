<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\DeclarationDechetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeclarationDechetRepository::class)]
class DeclarationDechet
{
    public const STATUT_EN_ATTENTE = 'EN_ATTENTE';
    public const STATUT_APPROUVEE = 'APPROUVEE';
    public const STATUT_REFUSEE = 'REFUSEE';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'declarationDechets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeDechet $typeDechet = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column]
    private ?float $quantite = null;

    #[ORM\Column(length: 255)]
    private ?string $unite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?float $scoreIa = null;

    #[ORM\Column]
    private int $pointsAttribues = 0;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $qrCode = null;

    #[ORM\ManyToOne(inversedBy: 'declarations')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $citoyen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description ?? '';

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTypeDechet(): ?TypeDechet
    {
        return $this->typeDechet;
    }

    public function setTypeDechet(?TypeDechet $TypeDechet): static
    {
        $this->typeDechet = $TypeDechet;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(string $unite): static
    {
        $this->unite = $unite;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getScoreIa(): ?float
    {
        return $this->scoreIa;
    }

    public function setScoreIa(?float $scoreIa): static
    {
        $this->scoreIa = $scoreIa;

        return $this;
    }

    public function getPointsAttribues(): int
    {
        return $this->pointsAttribues;
    }

    public function setPointsAttribues(int $pointsAttribues): static
    {
        $this->pointsAttribues = $pointsAttribues;

        return $this;
    }

    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    public function setQrCode(?string $qrCode): static
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    public function getCitoyen(): ?User
    {
        return $this->citoyen;
    }

    public function setCitoyen(?User $citoyen): static
    {
        $this->citoyen = $citoyen;

        return $this;
    }
}
