<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cet email.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const TYPE_CITIZEN   = 'CITIZEN';
    public const TYPE_VALORIZER = 'VALORIZER';
    public const TYPE_PARTNER   = 'PARTNER';
    public const TYPE_ADMIN     = 'ADMIN';

    public const ROLE_VALORIZER = 'ROLE_VALORIZER';
    public const ROLE_PARTNER   = 'ROLE_PARTNER';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "Email invalide.")]
    #[Assert\Length(max: 180, maxMessage: "L'email ne doit pas dépasser {{ limit }} caractères.")]
    private ?string $email = null;

    /**
     * @var list<string>
     */
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    // ✅ contrôle côté serveur (au moins 8 caractères)
    #[ORM\Column]
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire.")]
    #[Assert\Length(
        min: 8,
        max: 255,
        minMessage: "Le mot de passe doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le mot de passe ne doit pas dépasser {{ limit }} caractères."
    )]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom ne doit pas dépasser {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: "/^[\p{L}\s'-]+$/u",
        message: "Le nom ne doit contenir que des lettres, espaces, apostrophes ou tirets."
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: "Le prénom doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le prénom ne doit pas dépasser {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: "/^[\p{L}\s'-]+$/u",
        message: "Le prénom ne doit contenir que des lettres, espaces, apostrophes ou tirets."
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(
        min: 8,
        max: 20,
        minMessage: "Le téléphone doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le téléphone ne doit pas dépasser {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: "/^\+?[0-9\s\-]+$/",
        message: "Téléphone invalide (chiffres, espaces, tirets, + autorisés)."
    )]
    private ?string $telephone = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "Le type d'utilisateur est obligatoire.")]
    #[Assert\Choice(
        choices: [self::TYPE_CITIZEN, self::TYPE_VALORIZER, self::TYPE_PARTNER, self::TYPE_ADMIN],
        message: "Type invalide."
    )]
    private string $type = self::TYPE_CITIZEN;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(options: ['default' => false])]
    private bool $isVerified = false;

    #[ORM\Column(options: ['default' => 0])]
    #[Assert\PositiveOrZero(message: "Les EcoPoints ne peuvent pas être négatifs.")]
    private int $ecoPoints = 0;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Dechet::class)]
    private Collection $dechets;

    #[ORM\OneToMany(mappedBy: 'validatedBy', targetEntity: Dechet::class)]
    private Collection $validatedDechets;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->type = self::TYPE_CITIZEN;
        $this->roles = ['ROLE_USER'];
        $this->isVerified = false;
        $this->ecoPoints = 0;

        $this->dechets = new ArrayCollection();
        $this->validatedDechets = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getEmail(): ?string { return $this->email; }

    public function setEmail(string $email): static
    {
        // ✅ normalisation serveur
        $this->email = mb_strtolower(trim($email));
        return $this;
    }

    public function getUserIdentifier(): string { return (string) $this->email; }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_values(array_unique($roles));
    }

    public function setRoles(array $roles): static
    {
        $this->roles = array_values(array_unique($roles));
        return $this;
    }

    public function getPassword(): ?string { return $this->password; }

    public function setPassword(string $password): static
    {
        // ⚠️ Ici tu stockes le HASH (pas le password clair).
        // Le contrôle (min 8) sert surtout côté form avant hash, mais acceptable PIDEV.
        $this->password = $password;
        return $this;
    }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = trim($nom); return $this; }

    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): static { $this->prenom = trim($prenom); return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone !== null ? trim($telephone) : null;
        return $this;
    }

    public function getType(): string { return $this->type; }

    public function setType(string $type): static
    {
        $this->type = $type;

        $roles = ['ROLE_USER'];

        if ($type === self::TYPE_ADMIN) {
            $roles[] = 'ROLE_ADMIN';
        } elseif ($type === self::TYPE_PARTNER) {
            $roles[] = self::ROLE_PARTNER;
        } elseif ($type === self::TYPE_VALORIZER) {
            $roles[] = self::ROLE_VALORIZER;
        }

        $this->roles = $roles;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }

    public function isVerified(): bool { return $this->isVerified; }
    public function setIsVerified(bool $isVerified): static { $this->isVerified = $isVerified; return $this; }

    public function getEcoPoints(): int { return $this->ecoPoints; }

    public function setEcoPoints(int $ecoPoints): static
    {
        $this->ecoPoints = max(0, $ecoPoints);
        return $this;
    }

    public function addEcoPoints(int $points): static
    {
        $this->ecoPoints = max(0, $this->ecoPoints + max(0, $points));
        return $this;
    }

    public function getDechets(): Collection { return $this->dechets; }

    public function addDechet(Dechet $dechet): static
    {
        if (!$this->dechets->contains($dechet)) {
            $this->dechets->add($dechet);
            $dechet->setUser($this);
        }
        return $this;
    }

    public function removeDechet(Dechet $dechet): static
    {
        if ($this->dechets->removeElement($dechet)) {
            if ($dechet->getUser() === $this) {
                $dechet->setUser(null);
            }
        }
        return $this;
    }

    public function getValidatedDechets(): Collection { return $this->validatedDechets; }

    public function eraseCredentials(): void {}
}
