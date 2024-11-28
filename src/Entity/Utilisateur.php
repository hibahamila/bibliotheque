<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 80)]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    private ?string $telephone = null;

    /**
     * @var Collection<int, Emprunt>
     */
    #[ORM\OneToMany(targetEntity: Emprunt::class, mappedBy: 'utilisateurs')]
    private Collection $historique_emprunts;

    public function __construct()
    {
        $this->historique_emprunts = new ArrayCollection();
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

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getHistoriqueEmprunts(): Collection
    {
        return $this->historique_emprunts;
    }

    public function addHistoriqueEmprunt(Emprunt $historiqueEmprunt): static
    {
        if (!$this->historique_emprunts->contains($historiqueEmprunt)) {
            $this->historique_emprunts->add($historiqueEmprunt);
            $historiqueEmprunt->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeHistoriqueEmprunt(Emprunt $historiqueEmprunt): static
    {
        if ($this->historique_emprunts->removeElement($historiqueEmprunt)) {
            // set the owning side to null (unless already changed)
            if ($historiqueEmprunt->getUtilisateurs() === $this) {
                $historiqueEmprunt->setUtilisateurs(null);
            }
        }

        return $this;
    }

   
    
}
