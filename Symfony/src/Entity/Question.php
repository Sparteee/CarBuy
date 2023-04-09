<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['reponse']])]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("reponse")]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("reponse")]
    private $contenu;

    #[ORM\OneToMany(mappedBy: 'questions', targetEntity: Reponse::class)]
    #[Groups("reponse")]
    private $reponses;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setQuestions($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestions() === $this) {
                $reponse->setQuestions(null);
            }
        }

        return $this;
    }
}
