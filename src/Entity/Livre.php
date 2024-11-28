<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column(length: 80)]
    private ?string $ISBN = null;

    #[ORM\Column]
    private ?bool $disponibilite = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Auteur $auteurs = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genres = null;

    /**
     * @var Collection<int, Emprunt>
     */
    #[ORM\OneToMany(targetEntity: Emprunt::class, mappedBy: 'livres')]
    private Collection $utilisateurs;

    

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $image = null;

    /**
     * @var Collection<int, Emprunt>
     */
    #[ORM\OneToMany(targetEntity: Emprunt::class, mappedBy: 'livre')]
    private Collection $emprunts;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): static
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function isDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getAuteurs(): ?Auteur
    {
        return $this->auteurs;
    }

    public function setAuteurs(?Auteur $auteurs): static
    {
        $this->auteurs = $auteurs;

        return $this;
    }

    public function getGenres(): ?Genre
    {
        return $this->genres;
    }

    public function setGenres(?Genre $genres): static
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Emprunt $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setLivres($this);
        }

        return $this;
    }

    public function removeUtilisateur(Emprunt $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getLivres() === $this) {
                $utilisateur->setLivres(null);
            }
        }

        return $this;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

//     #[ORM\Column(type: 'boolean', options: ['default' => false])]
//     private bool $deleted = false;

//     public function isDeleted(): bool
//   {
//     return $this->deleted;
//    }

//     public function setDeleted(bool $deleted): self
//    {
//     $this->deleted = $deleted;
//     return $this;
//     }

/**
 * @return Collection<int, Emprunt>
 */
public function getEmprunts(): Collection
{
    return $this->emprunts;
}

public function addEmprunt(Emprunt $emprunt): static
{
    if (!$this->emprunts->contains($emprunt)) {
        $this->emprunts->add($emprunt);
        $emprunt->setLivre($this);
    }

    return $this;
}

public function removeEmprunt(Emprunt $emprunt): static
{
    if ($this->emprunts->removeElement($emprunt)) {
        // set the owning side to null (unless already changed)
        if ($emprunt->getLivre() === $this) {
            $emprunt->setLivre(null);
        }
    }

    return $this;
}

}
