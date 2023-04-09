<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("reponse")]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("reponse")]
    private $contenuReponse;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("reponse")]
    private $valeurReponse;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'reponses')]
    private $questions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuReponse(): ?string
    {
        return $this->contenuReponse;
    }

    public function setContenuReponse(string $contenuReponse): self
    {
        $this->contenuReponse = $contenuReponse;

        return $this;
    }

    public function getValeurReponse(): ?string
    {
        return $this->valeurReponse;
    }

    public function setValeurReponse(string $valeurReponse): self
    {
        $this->valeurReponse = $valeurReponse;

        return $this;
    }

    public function getQuestions(): ?Question
    {
        return $this->questions;
    }

    public function setQuestions(?Question $questions): self
    {
        $this->questions = $questions;

        return $this;
    }
}
