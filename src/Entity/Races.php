<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RacesRepository")
 */
class Races
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="text")
     */
    private $Modifiers = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sentences", mappedBy="Race")
     */
    private $sentences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Warrior", mappedBy="Race")
     */
    private $warriors;

    public function __construct()
    {
        $this->sentences = new ArrayCollection();
        $this->warriors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getModifiers(): ?string
    {
        return $this->Modifiers;
    }

    public function setModifiers(?string $Modifiers): self
    {
        $this->Modifiers = $Modifiers;

        return $this;
    }

    /**
     * @return Collection|Sentences[]
     */
    public function getSentences(): Collection
    {
        return $this->sentences;
    }

    public function addSentence(Sentences $sentence): self
    {
        if (!$this->sentences->contains($sentence)) {
            $this->sentences[] = $sentence;
            $sentence->setRace($this);
        }

        return $this;
    }

    public function removeSentence(Sentences $sentence): self
    {
        if ($this->sentences->contains($sentence)) {
            $this->sentences->removeElement($sentence);
            // set the owning side to null (unless already changed)
            if ($sentence->getRace() === $this) {
                $sentence->setRace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Warrior[]
     */
    public function getWarriors(): Collection
    {
        return $this->warriors;
    }

    public function addWarrior(Warrior $warrior): self
    {
        if (!$this->warriors->contains($warrior)) {
            $this->warriors[] = $warrior;
            $warrior->setRace($this);
        }

        return $this;
    }

    public function removeWarrior(Warrior $warrior): self
    {
        if ($this->warriors->contains($warrior)) {
            $this->warriors->removeElement($warrior);
            // set the owning side to null (unless already changed)
            if ($warrior->getRace() === $this) {
                $warrior->setRace(null);
            }
        }

        return $this;
    }
}
