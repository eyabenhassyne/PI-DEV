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

    // ✅ champs utilisés dans tes formulaires
    #[ORM\Column(type: Types::STRING, length: 120)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::STRING, length: 120)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::STRING, length: 30, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::STRING, length: 20)]
    private string $type = self::TYPE_CITIZEN;

    // ✅ utilisé par EasyAdmin / tri / historique
   #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
private ?\DateTimeImmutable $createdAt = null;


    // ======================================
    // ✅ RELATIONS DECHETS
    // ======================================

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Dechet::class)]
    private Collection $dechets;

    #[ORM\OneToMany(mappedBy: 'validatedBy', targetEntity: Dechet::class)]
    private Collection $validatedDechets;

    public function __construct()
    {
        $this->dechets = new ArrayCollection();
        $this->validatedDechets = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function __toString(): string
    {
        return (string) $this->email;
    }

    // ======================================
    // ✅ Getters / Setters
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
        $this->email = strtolower(trim($email));
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    // pour compatibilité ancien code
    public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        // ✅ option : auto-injecter rôle selon type
        if ($this->type === self::TYPE_ADMIN) {
            $roles[] = 'ROLE_ADMIN';
        } elseif ($this->type === self::TYPE_VALORIZER) {
            $roles[] = 'ROLE_VALORIZER';
        }

        return array_values(array_unique($roles));
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // nothing
    }

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
        $this->telephone = $telephone ? trim($telephone) : null;
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

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
