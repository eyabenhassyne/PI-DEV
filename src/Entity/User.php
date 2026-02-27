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

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoProfil = null;

    #[ORM\Column(options: ['default' => true])]
    private bool $notifyValidation = true;

    #[ORM\Column(options: ['default' => true])]
    private bool $notifyPoints = true;

    #[ORM\Column(options: ['default' => true])]
    private bool $notifyRefus = true;

    #[ORM\Column(options: ['default' => true])]
    private bool $notifyNouvellesDeclarations = true;

    #[ORM\Column(length: 10, options: ['default' => 'fr'])]
    private string $langue = 'fr';

    #[ORM\Column(length: 20, options: ['default' => 'clair'])]
    private string $theme = 'clair';

    #[ORM\Column(length: 20, options: ['default' => 'kg'])]
    private string $unitePreferee = 'kg';

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $dateInscription = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $derniereConnexion = null;

    #[ORM\Column(length: 20, options: ['default' => 'ACTIF'])]
    private string $statutCentre = 'ACTIF';

    #[ORM\Column(nullable: true)]
    private ?float $capaciteMaxJournaliere = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $organisationCentre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zoneCouverture = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $typesDechetsAcceptes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stripeConnectAccountId = null;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: DeclarationDechet::class)]
    private Collection $declarations;

    #[ORM\OneToOne(mappedBy: 'utilisateur', targetEntity: Wallet::class)]
    private ?Wallet $wallet = null;

    public function __construct()
    {
        $this->declarations = new ArrayCollection();
        $this->dateInscription = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photoProfil;
    }

    public function setPhotoProfil(?string $photoProfil): static
    {
        $this->photoProfil = $photoProfil;

        return $this;
    }

    public function isNotifyValidation(): bool
    {
        return $this->notifyValidation;
    }

    public function setNotifyValidation(bool $notifyValidation): static
    {
        $this->notifyValidation = $notifyValidation;

        return $this;
    }

    public function isNotifyPoints(): bool
    {
        return $this->notifyPoints;
    }

    public function setNotifyPoints(bool $notifyPoints): static
    {
        $this->notifyPoints = $notifyPoints;

        return $this;
    }

    public function isNotifyRefus(): bool
    {
        return $this->notifyRefus;
    }

    public function setNotifyRefus(bool $notifyRefus): static
    {
        $this->notifyRefus = $notifyRefus;

        return $this;
    }

    public function isNotifyNouvellesDeclarations(): bool
    {
        return $this->notifyNouvellesDeclarations;
    }

    public function setNotifyNouvellesDeclarations(bool $notifyNouvellesDeclarations): static
    {
        $this->notifyNouvellesDeclarations = $notifyNouvellesDeclarations;

        return $this;
    }

    public function getLangue(): string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getUnitePreferee(): string
    {
        return $this->unitePreferee;
    }

    public function setUnitePreferee(string $unitePreferee): static
    {
        $this->unitePreferee = $unitePreferee;

        return $this;
    }

    public function getDateInscription(): ?\DateTime
    {
        return $this->dateInscription;
    }

    public function setDateInscription(?\DateTimeInterface $dateInscription): static
    {
        if ($dateInscription instanceof \DateTimeImmutable) {
            $dateInscription = \DateTime::createFromImmutable($dateInscription);
        }

        $this->dateInscription = $dateInscription instanceof \DateTime ? $dateInscription : null;

        return $this;
    }

    public function getDerniereConnexion(): ?\DateTime
    {
        return $this->derniereConnexion;
    }

    public function setDerniereConnexion(?\DateTimeInterface $derniereConnexion): static
    {
        if ($derniereConnexion instanceof \DateTimeImmutable) {
            $derniereConnexion = \DateTime::createFromImmutable($derniereConnexion);
        }

        $this->derniereConnexion = $derniereConnexion instanceof \DateTime ? $derniereConnexion : null;

        return $this;
    }

    public function getStatutCentre(): string
    {
        return $this->statutCentre;
    }

    public function setStatutCentre(string $statutCentre): static
    {
        $this->statutCentre = $statutCentre;

        return $this;
    }

    public function getCapaciteMaxJournaliere(): ?float
    {
        return $this->capaciteMaxJournaliere;
    }

    public function setCapaciteMaxJournaliere(?float $capaciteMaxJournaliere): static
    {
        $this->capaciteMaxJournaliere = $capaciteMaxJournaliere;

        return $this;
    }

    public function getOrganisationCentre(): ?string
    {
        return $this->organisationCentre;
    }

    public function setOrganisationCentre(?string $organisationCentre): static
    {
        $this->organisationCentre = $organisationCentre;

        return $this;
    }

    public function getZoneCouverture(): ?string
    {
        return $this->zoneCouverture;
    }

    public function setZoneCouverture(?string $zoneCouverture): static
    {
        $this->zoneCouverture = $zoneCouverture;

        return $this;
    }

    public function getTypesDechetsAcceptes(): ?string
    {
        return $this->typesDechetsAcceptes;
    }

    public function setTypesDechetsAcceptes(?string $typesDechetsAcceptes): static
    {
        $this->typesDechetsAcceptes = $typesDechetsAcceptes;

        return $this;
    }

    public function getStripeConnectAccountId(): ?string
    {
        return $this->stripeConnectAccountId;
    }

    public function setStripeConnectAccountId(?string $stripeConnectAccountId): static
    {
        $this->stripeConnectAccountId = $stripeConnectAccountId;

        return $this;
    }

    /**
     * @return Collection<int, DeclarationDechet>
     */
    public function getDeclarations(): Collection
    {
        return $this->declarations;
    }

    public function addDeclaration(DeclarationDechet $declaration): static
    {
        if (!$this->declarations->contains($declaration)) {
            $this->declarations->add($declaration);
            $declaration->setCitoyen($this);
        }

        return $this;
    }

    public function removeDeclaration(DeclarationDechet $declaration): static
    {
        if ($this->declarations->removeElement($declaration)) {
            if ($declaration->getCitoyen() === $this) {
                $declaration->setCitoyen(null);
            }
        }

        return $this;
    }

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(?Wallet $wallet): static
    {
        $this->wallet = $wallet;

        return $this;
    }
}
