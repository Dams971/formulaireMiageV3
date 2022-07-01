<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1200)
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity=Reponses::class, mappedBy="question")
     */
    private $reponses;

    /**
     * @ORM\ManyToOne(targetEntity=Formulaires::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formulaire;

    /**
     * @ORM\ManyToOne(targetEntity=Formulaires::class, inversedBy="question")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formulaires;


    public function __construct()
    {
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }


    /**
     * @return Collection<int, Reponses>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponses $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setQuestion($this);
        }

        return $this;
    }

    public function removeReponse(Reponses $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestion() === $this) {
                $reponse->setQuestion(null);
            }
        }

        return $this;
    }

    public function getFormulaire(): ?Formulaires
    {
        return $this->formulaire;
    }

    public function setFormulaire(?Formulaires $formulaire): self
    {
        $this->formulaire = $formulaire;

        return $this;
    }

    public function getFormulaires(): ?Formulaires
    {
        return $this->formulaires;
    }

    public function setFormulaires(?Formulaires $formulaires): self
    {
        $this->formulaires = $formulaires;

        return $this;
    }

    // getter and setter for the formulaires
    public function getFormulairesId(): ?int
    {
        return $this->formulaires->getId();
    }

    public function setFormulairesId(?int $formulairesId): self
    {
        $this->formulaires = $formulairesId;

        return $this;
    }
}
