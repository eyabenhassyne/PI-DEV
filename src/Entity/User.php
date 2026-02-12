<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    // ======================================
    // ✅ RELATIONS DECHETS (IMPORTANT)
    // ======================================

    // Déclarations faites par le citoyen
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Dechet::class, orphanRemoval: false)]
    private Collection $dechets;

    // Déchets validés/refusés par le valorisateur
    #[ORM\OneToMany(mappedBy: 'validatedBy', targetEntity: Dechet::class, orphanRemoval: false)]
    private Collection $validatedDechets;

    public function __construct()
    {
        $this->dechets = new ArrayCollection();
        $this->validatedDechets = new ArrayCollection();
    }

    // ======================================
    // ✅ Getters / Setters User
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

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
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

    // ======================================
    // ✅ RELATION dechets
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

    // ======================================
    // ✅ RELATION validatedDechets
    // ======================================

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
