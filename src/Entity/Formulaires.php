<?php

namespace App\Entity;

use App\Repository\FormulairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormulairesRepository::class)
 */
class Formulaires
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity=Questions::class, mappedBy="formulaire", orphanRemoval=true)
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=Questions::class, mappedBy="formulaires", orphanRemoval=true)
     */
    private $question;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->question = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setFormulaire($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getFormulaire() === $this) {
                $question->setFormulaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    // getter and setter for the question property

    public function setQuestion(Collection $question): self
    {
        $this->question = $question;
        return $this;
    }

    /**
    public function __ToInt(): int
    {
        return $this->getId()-> $this->__toString();
    }
    */

    /**
     * @return string
     */
    public function __ToString()
    {
        return $this->getId().'-'.$this->getTitre();
    }

}
