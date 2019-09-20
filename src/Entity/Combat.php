<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CombatRepository")
 */
class Combat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warrior")
     * @ORM\JoinColumn(nullable=false)
     */
    private $FirstWarrior;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warrior")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SecondWarrior;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CombatLine", mappedBy="Combat", orphanRemoval=true)
     */
    private $combatLines;

    public function __construct()
    {
        $this->combatLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getFirstWarrior(): ?Warrior
    {
        return $this->FirstWarrior;
    }

    public function setFirstWarrior(?Warrior $FirstWarrior): self
    {
        $this->FirstWarrior = $FirstWarrior;

        return $this;
    }

    public function getSecondWarrior(): ?Warrior
    {
        return $this->SecondWarrior;
    }

    public function setSecondWarrior(?Warrior $SecondWarrior): self
    {
        $this->SecondWarrior = $SecondWarrior;

        return $this;
    }

    /**
     * @return Collection|CombatLine[]
     */
    public function getCombatLines(): Collection
    {
        return $this->combatLines;
    }

    public function addCombatLine(CombatLine $combatLine): self
    {
        if (!$this->combatLines->contains($combatLine)) {
            $this->combatLines[] = $combatLine;
            $combatLine->setCombat($this);
        }

        return $this;
    }

    public function removeCombatLine(CombatLine $combatLine): self
    {
        if ($this->combatLines->contains($combatLine)) {
            $this->combatLines->removeElement($combatLine);
            // set the owning side to null (unless already changed)
            if ($combatLine->getCombat() === $this) {
                $combatLine->setCombat(null);
            }
        }

        return $this;
    }
}
