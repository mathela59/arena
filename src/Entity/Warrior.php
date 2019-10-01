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
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany (targetEntity="WarriorCharacteristic", mappedBy="Warrior")
     */
    private $WarriorCharacteristic;

    /**
     * @ORM\Column(type="integer")
     */
    private $Life;

    /**
     * @ORM\Column(type="integer")
     */
    private $Experience;

    /**
     * Warrior constructor.
     */


    public function __construct()
    {
        $this->Items = new ArrayCollection();
        $this->WarriorCharacteristic = new ArrayCollection();
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
    public function getWarriorCharacteristic(): Collection
    {
        return $this->WarriorCharacteristic;
    }

    public function addWarriorCharacteristic(WarriorCharacteristic $warriorCharacteristic): self
    {
        if (!$this->WarriorCharacteristic->contains($warriorCharacteristic)) {
            $this->WarriorCharacteristic[] = $$warriorCharacteristic;
        }

        return $this;
    }

    public function removeWarriorCharacteristic(WarriorCharacteristic $warriorCharacteristic): self
    {
        if ($this->WarriorCharacteristic->contains($warriorCharacteristic)) {
            $this->WarriorCharacteristic->removeElement($warriorCharacteristic);
        }

        return $this;
    }

    public function getLife(): ?int
    {
        return $this->Life;
    }

    public function setLife(int $Life): self
    {
        $this->Life = $Life;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->Experience;
    }

    public function setExperience(int $Experience): self
    {
        $this->Experience = $Experience;

        return $this;
    }

    public function getLevel(): ?int
    {
        return ($this->getExperience()/1000)+1;
    }
}
