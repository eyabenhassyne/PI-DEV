<?php

namespace App\Entity;

use App\Repository\DechetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: DechetRepository::class)]
#[Assert\Callback('validateBusinessRules')]
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
    #[Assert\Regex(
        pattern: "/^[\p{L}0-9\s'’\-_,.]+$/u",
        message: "Le type contient des caractères non autorisés."
    )]
    private ?string $type = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "La quantité est obligatoire.")]
    #[Assert\Positive(message: "La quantité doit être supérieure à 0.")]
    #[Assert\LessThanOrEqual(value: 10000, message: "La quantité est trop grande (max {{ compared_value }} kg).")]
    private ?float $quantiteKg = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "Le statut est obligatoire.")]
    #[Assert\Choice(
        choices: [self::STATUT_EN_ATTENTE, self::STATUT_VALIDE, self::STATUT_REFUSE],
        message: "Statut invalide."
    )]
    private string $statut = self::STATUT_EN_ATTENTE;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "L'adresse ne doit pas dépasser {{ limit }} caractères.")]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min: -90, max: 90, notInRangeMessage: "Latitude invalide (entre -90 et 90).")]
    private ?float $latitude = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min: -180, max: 180, notInRangeMessage: "Longitude invalide (entre -180 et 180).")]
    private ?float $longitude = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero(message: "L'estimation EcoPoints ne peut pas être négative.")]
    private ?int $estimationEcoPoints = null;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero(message: "Les EcoPoints attribués ne peuvent pas être négatifs.")]
    private ?int $ecoPointsAttribues = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $validatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'validatedDechets')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $validatedBy = null;

    // ✅ IMPORTANT : inversedBy="dechets" => User doit avoir $dechets
    #[ORM\ManyToOne(inversedBy: 'dechets')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->statut = self::STATUT_EN_ATTENTE;
    }

    public function validateBusinessRules(ExecutionContextInterface $context): void
    {
        $lat = $this->latitude;
        $lng = $this->longitude;

        if (($lat !== null && $lng === null) || ($lat === null && $lng !== null)) {
            $context->buildViolation("Si tu saisis la position, tu dois renseigner latitude ET longitude.")
                ->atPath('latitude')
                ->addViolation();
        }

        if (in_array($this->statut, [self::STATUT_VALIDE, self::STATUT_REFUSE], true)) {
            if ($this->validatedBy === null) {
                $context->buildViolation("Un déchet validé/refusé doit avoir un valorisateur (validatedBy).")
                    ->atPath('validatedBy')
                    ->addViolation();
            }
            if ($this->validatedAt === null) {
                $context->buildViolation("La date de traitement (validatedAt) est obligatoire si le statut est validé/refusé.")
                    ->atPath('validatedAt')
                    ->addViolation();
            }
        }

        if ($this->statut === self::STATUT_VALIDE && $this->ecoPointsAttribues === null) {
            $context->buildViolation("Les EcoPoints attribués sont obligatoires si le statut est VALIDE.")
                ->atPath('ecoPointsAttribues')
                ->addViolation();
        }

        if ($this->statut === self::STATUT_REFUSE && ($this->ecoPointsAttribues ?? 0) > 0) {
            $context->buildViolation("En cas de REFUS, les EcoPoints attribués doivent être à 0 (ou vides).")
                ->atPath('ecoPointsAttribues')
                ->addViolation();
        }
    }

    public function getId(): ?int { return $this->id; }

    public function getType(): ?string { return $this->type; }
    public function setType(string $type): self { $this->type = trim($type); return $this; }

    public function getQuantiteKg(): ?float { return $this->quantiteKg; }
    public function setQuantiteKg(float $quantiteKg): self { $this->quantiteKg = $quantiteKg; return $this; }

    public function getStatut(): string { return $this->statut; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }

    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(?string $adresse): self { $this->adresse = $adresse !== null ? trim($adresse) : null; return $this; }

    public function getLatitude(): ?float { return $this->latitude; }
    public function setLatitude(?float $latitude): self { $this->latitude = $latitude; return $this; }

    public function getLongitude(): ?float { return $this->longitude; }
    public function setLongitude(?float $longitude): self { $this->longitude = $longitude; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(\DateTimeImmutable $createdAt): self { $this->createdAt = $createdAt; return $this; }

    public function getEstimationEcoPoints(): ?int { return $this->estimationEcoPoints; }
    public function setEstimationEcoPoints(?int $v): self { $this->estimationEcoPoints = $v; return $this; }

    public function getEcoPointsAttribues(): ?int { return $this->ecoPointsAttribues; }
    public function setEcoPointsAttribues(?int $v): self { $this->ecoPointsAttribues = $v; return $this; }

    public function getValidatedAt(): ?\DateTimeImmutable { return $this->validatedAt; }
    public function setValidatedAt(?\DateTimeImmutable $v): self { $this->validatedAt = $v; return $this; }

    public function getValidatedBy(): ?User { return $this->validatedBy; }
    public function setValidatedBy(?User $v): self { $this->validatedBy = $v; return $this; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(?User $user): self { $this->user = $user; return $this; }
}
