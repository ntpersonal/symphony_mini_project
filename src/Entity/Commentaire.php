<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Contenu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\ManyToOne]
    private ?Personne $listeCommentairesP = null;

    #[ORM\ManyToOne]
    private ?Peinture $listeCommentairesPe = null;
    public function __subject(): object
    {
        return $this;
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

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): self
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getListeCommentairesP(): ?Personne
    {
        return $this->listeCommentairesP;
    }

    public function setListeCommentairesP(?Personne $listeCommentairesP): self
    {
        $this->listeCommentairesP = $listeCommentairesP;

        return $this;
    }

    public function getListeCommentairesPe(): ?Peinture
    {
        return $this->listeCommentairesPe;
    }

    public function setListeCommentairesPe(?Peinture $listeCommentairesPe): self
    {
        $this->listeCommentairesPe = $listeCommentairesPe;

        return $this;
    }
}
