<?php

namespace App\Entity;

use App\Repository\PropositionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PropositionRepository::class)]
#[ORM\Index(columns: ["statut"], name: "idx_prop_statut")]
class Proposition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    #[Assert\NotBlank(message: "Le nom du proposant est obligatoire.")]
    #[Assert\Length(max: 120)]
    private ?string $nomProposant = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "Email invalide.")]
    #[Assert\Length(max: 180)]
    private ?string $email = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotNull(message: "Le montant est obligatoire.")]
    #[Assert\Positive(message: "Le montant doit être > 0.")]
    private ?float $montant = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotNull(message: "Le délai est obligatoire.")]
    #[Assert\Positive(message: "Le délai doit être > 0.")]
    private ?int $delaiJours = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: "Le message est obligatoire.")]
    #[Assert\Length(min: 5)]
    private ?string $message = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(choices: ['EN_ATTENTE', 'ACCEPTEE', 'REFUSEE'], message: "Statut invalide.")]
    private string $statut = 'EN_ATTENTE';

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(inversedBy: 'propositions')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?AppelOffre $appelOffre = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }

    public function getNomProposant(): ?string { return $this->nomProposant; }
    public function setNomProposant(string $nomProposant): self { $this->nomProposant = $nomProposant; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getMontant(): ?float { return $this->montant; }
    public function setMontant(float $montant): self { $this->montant = $montant; return $this; }

    public function getDelaiJours(): ?int { return $this->delaiJours; }
    public function setDelaiJours(int $delaiJours): self { $this->delaiJours = $delaiJours; return $this; }

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(string $message): self { $this->message = $message; return $this; }

    public function getStatut(): string { return $this->statut; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }

    public function getAppelOffre(): ?AppelOffre { return $this->appelOffre; }
    public function setAppelOffre(?AppelOffre $appelOffre): self { $this->appelOffre = $appelOffre; return $this; }
}
