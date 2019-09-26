<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WarriorRepository")
 */
class Warrior
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
     * @ORM\ManyToOne(targetEntity="App\Entity\FightingStyle", inversedBy="FightStyle")
     * @ORM\JoinColumn(nullable=false)
     */
    private $FightingStyle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Races", inversedBy="warriors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Race;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Items", inversedBy="warriors")
     */
    private $Items;

    /**
     * @ORM\Column(type="integer")
     */
    private $Victories;

    /**
     * @ORM\Column(type="integer")
     */
    private $Defeats;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="warriors")
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WarriorCharacteristic", mappedBy="Warrior", orphanRemoval=true)
     */
    private $warriorCharacteristics;

    public function __construct()
    {
        $this->Items = new ArrayCollection();
        $this->Characteristics = new ArrayCollection();
        $this->warriorCharacteristics = new ArrayCollection();
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

    public function getFightingStyle(): ?FightingStyle
    {
        return $this->FightingStyle;
    }

    public function setFightingStyle(?FightingStyle $FightingStyle): self
    {
        $this->FightingStyle = $FightingStyle;

        return $this;
    }

    public function getRace(): ?Races
    {
        return $this->Race;
    }

    public function setRace(?Races $Race): self
    {
        $this->Race = $Race;

        return $this;
    }

    /**
     * @return Collection|Items[]
     */
    public function getItems(): Collection
    {
        return $this->Items;
    }

    public function addItem(Items $item): self
    {
        if (!$this->Items->contains($item)) {
            $this->Items[] = $item;
        }

        return $this;
    }

    public function removeItem(Items $item): self
    {
        if ($this->Items->contains($item)) {
            $this->Items->removeElement($item);
        }

        return $this;
    }

    /**
     * @return Collection|Characteristic[]
     */
    public function getCharacteristics(): Collection
    {
        return $this->Characteristics;
    }

    public function addCharacteristic(Characteristic $characteristic): self
    {
        if (!$this->Characteristics->contains($characteristic)) {
            $this->Characteristics[] = $characteristic;
        }

        return $this;
    }

    public function removeCharacteristic(Characteristic $characteristic): self
    {
        if ($this->Characteristics->contains($characteristic)) {
            $this->Characteristics->removeElement($characteristic);
        }

        return $this;
    }

    public function getVictories(): ?int
    {
        return $this->Victories;
    }

    public function setVictories(int $Victories): self
    {
        $this->Victories = $Victories;

        return $this;
    }

    public function getDefeats(): ?int
    {
        return $this->Defeats;
    }

    public function setDefeats(int $Defeats): self
    {
        $this->Defeats = $Defeats;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|WarriorCharacteristic[]
     */
    public function getWarriorCharacteristics(): Collection
    {
        return $this->warriorCharacteristics;
    }

    public function addWarriorCharacteristic(WarriorCharacteristic $warriorCharacteristic): self
    {
        if (!$this->warriorCharacteristics->contains($warriorCharacteristic)) {
            $this->warriorCharacteristics[] = $warriorCharacteristic;
            $warriorCharacteristic->setWarrior($this);
        }

        return $this;
    }

    public function removeWarriorCharacteristic(WarriorCharacteristic $warriorCharacteristic): self
    {
        if ($this->warriorCharacteristics->contains($warriorCharacteristic)) {
            $this->warriorCharacteristics->removeElement($warriorCharacteristic);
            // set the owning side to null (unless already changed)
            if ($warriorCharacteristic->getWarrior() === $this) {
                $warriorCharacteristic->setWarrior(null);
            }
        }

        return $this;
    }
}
