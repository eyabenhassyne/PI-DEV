<?php

namespace App\Entity;

use App\Repository\PartenaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartenaireRepository::class)]
class Partenaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private string $nomEntreprise = '';

    #[ORM\Column(length: 80)]
    private string $categorie = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteWeb = null;

    #[ORM\Column]
    private bool $actif = true;

    /** @var Collection<int, Recompense> */
    #[ORM\OneToMany(mappedBy: 'partenaire', targetEntity: Recompense::class, orphanRemoval: true)]
    private Collection $recompenses;

    public function __construct()
    {
        $this->recompenses = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getNomEntreprise(): string { return $this->nomEntreprise; }
    public function setNomEntreprise(string $nomEntreprise): self { $this->nomEntreprise = $nomEntreprise; return $this; }

    public function getCategorie(): string { return $this->categorie; }
    public function setCategorie(string $categorie): self { $this->categorie = $categorie; return $this; }

    public function getSiteWeb(): ?string { return $this->siteWeb; }
    public function setSiteWeb(?string $siteWeb): self { $this->siteWeb = $siteWeb; return $this; }

    public function isActif(): bool { return $this->actif; }
    public function setActif(bool $actif): self { $this->actif = $actif; return $this; }

    /** @return Collection<int, Recompense> */
    public function getRecompenses(): Collection { return $this->recompenses; }

    public function addRecompense(Recompense $r): self
    {
        if (!$this->recompenses->contains($r)) {
            $this->recompenses->add($r);
            $r->setPartenaire($this);
        }
        return $this;
    }

    public function removeRecompense(Recompense $r): self
    {
        if ($this->recompenses->removeElement($r)) {
            if ($r->getPartenaire() === $this) {
                $r->setPartenaire(null); // orphanRemoval gère la suppression
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->nomEntreprise;
    }
}
