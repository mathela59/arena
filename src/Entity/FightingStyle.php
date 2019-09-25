<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FightingStyleRepository")
 */
class FightingStyle
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Modifiers = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sentences", mappedBy="Style")
     */
    private $sentences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Warrior", mappedBy="FightingStyle")
     */
    private $FightStyle;

    public function __construct()
    {
        $this->sentences = new ArrayCollection();
        $this->FightStyle = new ArrayCollection();
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

    public function setModifiers(string $Modifiers): self
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
            $sentence->setStyle($this);
        }

        return $this;
    }

    public function removeSentence(Sentences $sentence): self
    {
        if ($this->sentences->contains($sentence)) {
            $this->sentences->removeElement($sentence);
            // set the owning side to null (unless already changed)
            if ($sentence->getStyle() === $this) {
                $sentence->setStyle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Warrior[]
     */
    public function getFightStyle(): Collection
    {
        return $this->FightStyle;
    }

    public function addFightStyle(Warrior $fightStyle): self
    {
        if (!$this->FightStyle->contains($fightStyle)) {
            $this->FightStyle[] = $fightStyle;
            $fightStyle->setFightingStyle($this);
        }

        return $this;
    }

    public function removeFightStyle(Warrior $fightStyle): self
    {
        if ($this->FightStyle->contains($fightStyle)) {
            $this->FightStyle->removeElement($fightStyle);
            // set the owning side to null (unless already changed)
            if ($fightStyle->getFightingStyle() === $this) {
                $fightStyle->setFightingStyle(null);
            }
        }

        return $this;
    }
}
