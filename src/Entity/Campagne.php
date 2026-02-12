<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CampagneRepository::class)]
class Campagne
{
    public const STATUT_BROUILLON = 'BROUILLON';
    public const STATUT_ACTIVE    = 'ACTIVE';
    public const STATUT_TERMINEE  = 'TERMINEE';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 140)]
    #[Assert\NotBlank(message: "Le titre est obligatoire.")]
    #[Assert\Length(min: 3, max: 140)]
    private ?string $titre = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    /**
     * ✅ Début : aujourd'hui ou après (pas de passé)
     */
    #[ORM\Column(type: 'date_immutable')]
    #[Assert\NotNull(message: "Date début obligatoire.")]
    #[Assert\GreaterThanOrEqual(
        "today",
        message: "La date début ne peut pas être dans le passé."
    )]
    private ?\DateTimeImmutable $dateDebut = null;

    /**
     * ✅ Fin : strictement après début (au moins le lendemain)
     */
    #[ORM\Column(type: 'date_immutable')]
    #[Assert\NotNull(message: "Date fin obligatoire.")]
    #[Assert\GreaterThan(
        propertyPath: "dateDebut",
        message: "La date fin doit être après la date début (au moins le lendemain)."
    )]
    private ?\DateTimeImmutable $dateFin = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(choices: [self::STATUT_BROUILLON, self::STATUT_ACTIVE, self::STATUT_TERMINEE])]
    private string $statut = self::STATUT_BROUILLON;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    /** @var Collection<int, Participation> */
    #[ORM\OneToMany(mappedBy: 'campagne', targetEntity: Participation::class, orphanRemoval: true)]
    private Collection $participations;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->participations = new ArrayCollection();

        // ✅ Synchronisation automatique avec la date réelle (aujourd'hui)
        $this->dateDebut = new \DateTimeImmutable('today');
    }

    public function __toString(): string
    {
        return (string) $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDateDebut(): ?\DateTimeImmutable
    {
        return $this->dateDebut;
    }

    /**
     * ✅ Tu peux garder le setter si tu veux modifier la date début,
     * mais elle reste contrôlée (pas dans le passé).
     */
    public function setDateDebut(\DateTimeImmutable $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeImmutable $dateFin): self
    {
        $this->dateFin = $dateFin;
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

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /** @return Collection<int, Participation> */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }
}
