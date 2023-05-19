<?php

namespace App\Entity;

use App\Repository\PeintureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeintureRepository::class)]
class Peinture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $Nom = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 5)]
    private ?string $largeur = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 5)]
    private ?string $Hauteur = null;

    #[ORM\Column]
    private ?bool $en_vente = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $prix = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_realisation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Catégoire::class, inversedBy: 'listePeintures')]
    private Collection $listeCategoire;
    public function __subject(): object
    {
        return $this;
    }
    public function __construct()
    {
        $this->listeCategoire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getLargeur(): ?string
    {
        return $this->largeur;
    }

    public function setLargeur(string $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getHauteur(): ?string
    {
        return $this->Hauteur;
    }

    public function setHauteur(string $Hauteur): self
    {
        $this->Hauteur = $Hauteur;

        return $this;
    }

    public function isEnVente(): ?bool
    {
        return $this->en_vente;
    }

    public function setEnVente(bool $en_vente): self
    {
        $this->en_vente = $en_vente;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateRealisation(): ?\DateTimeInterface
    {
        return $this->date_realisation;
    }

    public function setDateRealisation(\DateTimeInterface $date_realisation): self
    {
        $this->date_realisation = $date_realisation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Catégoire>
     */
    public function getListeCategoire(): Collection
    {
        return $this->listeCategoire;
    }

    public function addListeCategoire(Catégoire $listeCategoire): self
    {
        if (!$this->listeCategoire->contains($listeCategoire)) {
            $this->listeCategoire->add($listeCategoire);
        }

        return $this;
    }

    public function removeListeCategoire(Catégoire $listeCategoire): self
    {
        $this->listeCategoire->removeElement($listeCategoire);

        return $this;
    }
}
