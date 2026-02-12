<?php

namespace App\Entity;

use App\Repository\TypeDechetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeDechetRepository::class)]
class TypeDechet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idType = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?float $valeurPointsKG = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionTri = null;

    /**
     * @var Collection<int, DeclarationDechet>
     */
    #[ORM\OneToMany(targetEntity: DeclarationDechet::class, mappedBy: 'TypeDechet')]
    private Collection $DeclarationDechet;

    public function __construct()
    {
        $this->DeclarationDechet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdType(): ?int
    {
        return $this->idType;
    }

    public function setIdType(int $idType): static
    {
        $this->idType = $idType;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getValeurPointsKG(): ?float
    {
        return $this->valeurPointsKG;
    }

    public function setValeurPointsKG(float $valeurPointsKG): static
    {
        $this->valeurPointsKG = $valeurPointsKG;

        return $this;
    }

    public function getDescriptionTri(): ?string
    {
        return $this->descriptionTri;
    }

    public function setDescriptionTri(string $descriptionTri): static
    {
        $this->descriptionTri = $descriptionTri;

        return $this;
    }

    /**
     * @return Collection<int, DeclarationDechet>
     */
    public function getDeclarationDechet(): Collection
    {
        return $this->DeclarationDechet;
    }

    public function addDeclarationDechet(DeclarationDechet $declarationDechet): static
    {
        if (!$this->DeclarationDechet->contains($declarationDechet)) {
            $this->DeclarationDechet->add($declarationDechet);
            $declarationDechet->setTypeDechet($this);
        }

        return $this;
    }

    public function removeDeclarationDechet(DeclarationDechet $declarationDechet): static
    {
        if ($this->DeclarationDechet->removeElement($declarationDechet)) {
            // set the owning side to null (unless already changed)
            if ($declarationDechet->getTypeDechet() === $this) {
                $declarationDechet->setTypeDechet(null);
            }
        }

        return $this;
    }
}
