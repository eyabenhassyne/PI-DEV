<?php

namespace App\Entity;

use App\Repository\DechetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DechetRepository::class)]
class Dechet
{
    public const STATUT_EN_ATTENTE = 'EN_ATTENTE';
    public const STATUT_VALIDE     = 'VALIDE';
    public const STATUT_REFUSE     = 'REFUSE';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    #[Assert\NotBlank(message: "Le type est obligatoire.")]
    #[Assert\Length(max: 120, maxMessage: "Le type ne doit pas dépasser {{ limit }} caractères.")]
    private ?string $type = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "La quantité est obligatoire.")]
    #[Assert\Type(type: 'numeric', message: "La quantité doit être un nombre (pas de lettres).")]
    #[Assert\Positive(message: "La quantité doit être supérieure à 0.")]
    private ?float $quantiteKg = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(
        choices: [self::STATUT_EN_ATTENTE, self::STATUT_VALIDE, self::STATUT_REFUSE],
        message: "Statut invalide."
    )]
    private string $statut = self::STATUT_EN_ATTENTE;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "L'adresse ne doit pas dépasser {{ limit }} caractères.")]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    // ✅ Relation vers l'utilisateur (citoyen)
    // ⚠️ nullable:true pour éviter les erreurs si tu as d'anciennes données
    #[ORM\ManyToOne(inversedBy: 'dechets')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->statut = self::STATUT_EN_ATTENTE;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getQuantiteKg(): ?float
    {
        return $this->quantiteKg;
    }

    public function setQuantiteKg(float $quantiteKg): self
    {
        $this->quantiteKg = $quantiteKg;
        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }
}
