<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'uniq_user_email', columns: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const TYPE_CITIZEN   = 'CITIZEN';
    public const TYPE_VALORIZER = 'VALORIZER';
    public const TYPE_ADMIN     = 'ADMIN';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 180)]
    private ?string $email = null;

    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::STRING, length: 120)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::STRING, length: 120)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::STRING, length: 30, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::STRING, length: 20)]
    private string $type = self::TYPE_CITIZEN;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    // ======================================
    // ✅ NEW: Activation / Désactivation
    // ======================================
    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isActive = true;

    /**
     * ✅ Reconnaissance faciale (embedding/vecteur)
     * Stock JSON : [0.12, -0.03, ...]
     */
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $faceEmbedding = null;

    /**
     * ✅ Date du dernier enrôlement du visage
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $faceUpdatedAt = null;

    // ======================================
    // ✅ RELATIONS
    // ======================================

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Dechet::class, orphanRemoval: true)]
    private Collection $dechets;

    #[ORM\OneToMany(mappedBy: 'validatedBy', targetEntity: Dechet::class)]
    private Collection $validatedDechets;

    public function __construct()
    {
        $this->dechets = new ArrayCollection();
        $this->validatedDechets = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->isActive = true;
    }

    public function __toString(): string
    {
        return (string) ($this->email ?? '');
    }

    // ======================================
    // ✅ Security
    // ======================================

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = mb_strtolower(trim($email));
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) ($this->email ?? '');
    }

    // compat ancien code
    public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        // toujours ROLE_USER
        $roles[] = 'ROLE_USER';

        // ajouter rôle basé sur le type
        $roles[] = match ($this->type) {
            self::TYPE_ADMIN => 'ROLE_ADMIN',
            self::TYPE_VALORIZER => 'ROLE_VALORIZER',
            default => 'ROLE_CITIZEN',
        };

        return array_values(array_unique($roles));
    }

    public function setRoles(array $roles): self
    {
        $roles = array_values(array_filter($roles, fn($r) => is_string($r) && $r !== ''));
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return (string) ($this->password ?? '');
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // rien
    }

    // ======================================
    // ✅ NEW: isActive (activer/désactiver)
    // ======================================

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    // ======================================
    // ✅ Profil
    // ======================================

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = trim($nom);
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = trim($prenom);
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone !== null ? trim($telephone) : null;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $allowed = [self::TYPE_CITIZEN, self::TYPE_VALORIZER, self::TYPE_ADMIN];
        $this->type = in_array($type, $allowed, true) ? $type : self::TYPE_CITIZEN;
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

    // ======================================
    // ✅ Face Embedding (Reconnaissance faciale)
    // ======================================

    public function getFaceEmbedding(): ?array
    {
        return $this->faceEmbedding;
    }

    /**
     * Stocke un embedding propre:
     * - cast float
     * - retire NaN/INF
     * - met à jour faceUpdatedAt
     */
    public function setFaceEmbedding(?array $faceEmbedding): self
    {
        if ($faceEmbedding === null) {
            $this->faceEmbedding = null;
            $this->faceUpdatedAt = null;
            return $this;
        }

        $clean = [];
        foreach ($faceEmbedding as $v) {
            $f = (float) $v;
            if (!is_finite($f)) {
                continue;
            }
            $clean[] = $f;
        }

        // si trop court => on refuse / on vide
        if (count($clean) < 64) {
            $this->faceEmbedding = null;
            $this->faceUpdatedAt = null;
            return $this;
        }

        $this->faceEmbedding = $clean;
        $this->faceUpdatedAt = new \DateTimeImmutable();

        return $this;
    }

    public function hasFaceEmbedding(int $minSize = 64): bool
    {
        return is_array($this->faceEmbedding) && count($this->faceEmbedding) >= $minSize;
    }

    public function clearFaceEmbedding(): self
    {
        $this->faceEmbedding = null;
        $this->faceUpdatedAt = null;
        return $this;
    }

    public function getFaceUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->faceUpdatedAt;
    }

    public function setFaceUpdatedAt(?\DateTimeImmutable $faceUpdatedAt): self
    {
        $this->faceUpdatedAt = $faceUpdatedAt;
        return $this;
    }

    // ======================================
    // ✅ Relations Dechet
    // ======================================

    /** @return Collection<int, Dechet> */
    public function getDechets(): Collection
    {
        return $this->dechets;
    }

    public function addDechet(Dechet $dechet): self
    {
        if (!$this->dechets->contains($dechet)) {
            $this->dechets->add($dechet);
            $dechet->setUser($this);
        }
        return $this;
    }

    public function removeDechet(Dechet $dechet): self
    {
        if ($this->dechets->removeElement($dechet)) {
            if ($dechet->getUser() === $this) {
                $dechet->setUser(null);
            }
        }
        return $this;
    }

    /** @return Collection<int, Dechet> */
    public function getValidatedDechets(): Collection
    {
        return $this->validatedDechets;
    }

    public function addValidatedDechet(Dechet $dechet): self
    {
        if (!$this->validatedDechets->contains($dechet)) {
            $this->validatedDechets->add($dechet);
            $dechet->setValidatedBy($this);
        }
        return $this;
    }

    public function removeValidatedDechet(Dechet $dechet): self
    {
        if ($this->validatedDechets->removeElement($dechet)) {
            if ($dechet->getValidatedBy() === $this) {
                $dechet->setValidatedBy(null);
            }
        }
        return $this;
    }
}
