<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['test']])]
#[ApiFilter(SearchFilter::class, properties: ['categorie' => 'exact' , 'Carburant' => 'exact' , 'Vitesse' => 'exact'])]
#[ApiFilter(OrderFilter::class, properties: ['prix' => 'asc'])]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("test")]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("test")]
    private $nom;

    #[ORM\Column(type: 'integer')]
    #[Groups("test")]
    private $prix;

    // Une voiture ne peut avoir qu'une marque
    #[ORM\ManyToOne(targetEntity: Marque::class, inversedBy: 'voiture')]
    #[Groups("test")]
    private $marque;

    // Un voiture ne peut avoir qu'une catégorie
    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'voiture')]
    #[Groups("test")]
    private $categorie;

    // Une Voiture peut être présente dans plusieurs commandes
    #[ORM\ManyToMany(targetEntity: Commande::class, inversedBy: 'voiture')]
    private $commandes;

    #[ORM\Column(type: 'integer')]
    #[Groups("test")]
    private $cv;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("test")]
    private $Carburant;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups("test")]
    private $image;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups("test")]
    private $Vitesse;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        $this->commandes->removeElement($commande);

        return $this;
    }

    public function getCv(): ?int
    {
        return $this->cv;
    }

    public function setCv(int $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->Carburant;
    }

    public function setCarburant(string $Carburant): self
    {
        $this->Carburant = $Carburant;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVitesse(): ?string
    {
        return $this->Vitesse;
    }

    public function setVitesse(?string $Vitesse): self
    {
        $this->Vitesse = $Vitesse;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }


}
