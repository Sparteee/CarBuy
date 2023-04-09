<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource()]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    // Une commande peut avoir plusieurs voitures
    #[ORM\ManyToMany(targetEntity: Voiture::class, mappedBy: 'commandes')]
    private $voiture;

    // Une commande peut avoir qu'un seul utilisateur
    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'commandes')]
    private $utilisateurs;

    /**
     * @param $date
     * @param $voiture
     * @param $utilisateurs
     */
    public function __construct($date , $user)
    {
        $this->date = $date;
        $this->utilisateurs = $user;
        $this->voiture = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoiture(): Collection
    {
        return $this->voiture;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voiture->contains($voiture)) {
            $this->voiture[] = $voiture;
            $voiture->addCommande($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voiture->removeElement($voiture)) {
            $voiture->removeCommande($this);
        }

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateur
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?Utilisateur $utilisateurs): self
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }
}
