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
     * @ORM\OneToOne(targetEntity="App\Entity\WarriorCharacteristic",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Strength;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WarriorCharacteristic", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Constitution;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WarriorCharacteristic", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Intelligence;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WarriorCharacteristic", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Speed;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WarriorCharacteristic", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Dexterity;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WarriorCharacteristic", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Armor;

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

    public function getStrength(): ?WarriorCharacteristic
    {
        return $this->Strength;
    }

    public function setStrength(?WarriorCharacteristic $Strength): self
    {
        $this->Strength = $Strength;

        return $this;
    }

    public function getConstitution(): ?WarriorCharacteristic
    {
        return $this->Constitution;
    }

    public function setConstitution(?WarriorCharacteristic $Constitution): self
    {
        $this->Constitution = $Constitution;

        return $this;
    }

    public function getIntelligence(): ?WarriorCharacteristic
    {
        return $this->Intelligence;
    }

    public function setIntelligence(WarriorCharacteristic $Intelligence): self
    {
        $this->Intelligence = $Intelligence;

        return $this;
    }

    public function getSpeed(): ?WarriorCharacteristic
    {
        return $this->Speed;
    }

    public function setSpeed(WarriorCharacteristic $Speed): self
    {
        $this->Speed = $Speed;

        return $this;
    }

    public function getDexterity(): ?WarriorCharacteristic
    {
        return $this->Dexterity;
    }

    public function setDexterity(WarriorCharacteristic $Dexterity): self
    {
        $this->Dexterity = $Dexterity;

        return $this;
    }

    public function getArmor(): ?WarriorCharacteristic
    {
        return $this->Armor;
    }

    public function setArmor(WarriorCharacteristic $Armor): self
    {
        $this->Armor = $Armor;

        return $this;
    }
}
