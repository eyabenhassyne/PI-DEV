<?php

namespace App\Entity;

use App\Repository\CitoyenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitoyenRepository::class)]
class Citoyen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telephone = null;

    /**
     * @var Collection<int, ReponseOffre>
     */
    #[ORM\OneToMany(targetEntity: ReponseOffre::class, mappedBy: 'citoyen')]
    private Collection $reponseOffres;

    public function __construct()
    {
        $this->reponseOffres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, ReponseOffre>
     */
    public function getReponseOffres(): Collection
    {
        return $this->reponseOffres;
    }

    public function addReponseOffre(ReponseOffre $reponseOffre): static
    {
        if (!$this->reponseOffres->contains($reponseOffre)) {
            $this->reponseOffres->add($reponseOffre);
            $reponseOffre->setCitoyen($this);
        }

        return $this;
    }

    public function removeReponseOffre(ReponseOffre $reponseOffre): static
    {
        if ($this->reponseOffres->removeElement($reponseOffre)) {
            // set the owning side to null (unless already changed)
            if ($reponseOffre->getCitoyen() === $this) {
                $reponseOffre->setCitoyen(null);
            }
        }

        return $this;
    }
}
