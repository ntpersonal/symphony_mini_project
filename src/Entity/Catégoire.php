<?php

namespace App\Entity;

use App\Repository\CatégoireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: CatégoireRepository::class)]
class Catégoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $désingnation = null;

    #[ORM\ManyToMany(targetEntity: Peinture::class, mappedBy: 'listeCategoire')]
    private Collection $listePeintures;
    public function __subject(): object
    {
        return $this;
    }
    public function __construct()
    {
        $this->listePeintures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDésingnation(): ?string
    {
        return $this->désingnation;
    }

    public function setDésingnation(string $désingnation): self
    {
        $this->désingnation = $désingnation;

        return $this;
    }

    /**
     * @return Collection<int, Peinture>
     */
    public function getListePeintures(): Collection
    {
        return $this->listePeintures;
    }

    public function addListePeinture(Peinture $listePeinture): self
    {
        if (!$this->listePeintures->contains($listePeinture)) {
            $this->listePeintures->add($listePeinture);
            $listePeinture->addListeCategoire($this);
        }

        return $this;
    }

    public function removeListePeinture(Peinture $listePeinture): self
    {
        if ($this->listePeintures->removeElement($listePeinture)) {
            $listePeinture->removeListeCategoire($this);
        }

        return $this;
    }
}
