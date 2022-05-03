<?php

namespace App\Entity;

use App\Repository\WarriorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WarriorRepository::class)]
class Warrior
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'warriors')]
    #[ORM\JoinColumn(nullable: false)]
    private $Coach;

    #[ORM\Column(type: 'integer')]
    private $Experience;

    #[ORM\ManyToMany(targetEntity: Traits::class)]
    private $Traits;

    #[ORM\ManyToMany(targetEntity: Slots::class)]
    private $Slots;

    #[ORM\ManyToMany(targetEntity: Breed::class)]
    private $Breed;

    #[ORM\Column(type: 'integer')]
    private $Strength;

    #[ORM\Column(type: 'integer')]
    private $Speed;

    #[ORM\Column(type: 'integer')]
    private $Dexterity;

    #[ORM\Column(type: 'integer')]
    private $Constitution;

    #[ORM\Column(type: 'integer')]
    private $Intelligence;

    #[ORM\Column(type: 'integer')]
    private $Will;

    #[ORM\OneToMany(mappedBy: 'Warrior', targetEntity: Equipment::class)]
    private $equipment;

    #[ORM\OneToMany(mappedBy: 'first', targetEntity: Combat::class)]
    private $combats;

    #[ORM\OneToMany(mappedBy: 'Second', targetEntity: Combat::class)]
    private $combats_extra;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->Traits = new ArrayCollection();
        $this->Slots = new ArrayCollection();
        $this->Breed = new ArrayCollection();
        $this->equipment = new ArrayCollection();
        $this->combats = new ArrayCollection();
        $this->combats_extra = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCoach(): ?User
    {
        return $this->Coach;
    }

    public function setCoach(?User $Coach): self
    {
        $this->Coach = $Coach;

        return $this;
    }

    public function getFightStyle(): ?FightStyle
    {
        return $this->FightStyle;
    }

    public function setFightStyle(?FightStyle $FightStyle): self
    {
        $this->FightStyle = $FightStyle;

        return $this;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * @return Collection<int, Skills>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(Skills $skill): self
    {
        $this->skills->removeElement($skill);

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

    /**
     * @return Collection<int, Traits>
     */
    public function getTraits(): Collection
    {
        return $this->Traits;
    }

    public function addTrait(Traits $trait): self
    {
        if (!$this->Traits->contains($trait)) {
            $this->Traits[] = $trait;
        }

        return $this;
    }

    public function removeTrait(Traits $trait): self
    {
        $this->Traits->removeElement($trait);

        return $this;
    }

    /**
     * @return Collection<int, Slots>
     */
    public function getSlots(): Collection
    {
        return $this->Slots;
    }

    public function addSlot(Slots $slot): self
    {
        if (!$this->Slots->contains($slot)) {
            $this->Slots[] = $slot;
        }

        return $this;
    }

    public function removeSlot(Slots $slot): self
    {
        $this->Slots->removeElement($slot);

        return $this;
    }

    public function addBreed(Breed $breed): self
    {
        if (!$this->Breed->contains($breed)) {
            $this->Breed[] = $breed;
        }

        return $this;
    }

    public function removeBreed(Breed $breed): self
    {
        $this->Breed->removeElement($breed);

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->Strength;
    }

    public function setStrength(int $Strength): self
    {
        $this->Strength = $Strength;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->Speed;
    }

    public function setSpeed(int $Speed): self
    {
        $this->Speed = $Speed;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->Dexterity;
    }

    public function setDexterity(int $Dexterity): self
    {
        $this->Dexterity = $Dexterity;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->Constitution;
    }

    public function setConstitution(int $Constitution): self
    {
        $this->Constitution = $Constitution;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->Intelligence;
    }

    public function setIntelligence(int $Intelligence): self
    {
        $this->Intelligence = $Intelligence;

        return $this;
    }

    public function getWill(): ?int
    {
        return $this->Will;
    }

    public function setWill(int $Will): self
    {
        $this->Will = $Will;

        return $this;
    }

    /**
     * @return Collection<int, Equipment>
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment[] = $equipment;
            $equipment->setWarrior($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipment->removeElement($equipment)) {
            // set the owning side to null (unless already changed)
            if ($equipment->getWarrior() === $this) {
                $equipment->setWarrior(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Combat>
     */
    public function getCombats(): Collection
    {
        return $this->combats;
    }

    public function addCombat(Combat $combat): self
    {
        if (!$this->combats->contains($combat)) {
            $this->combats[] = $combat;
            $combat->setFirst($this);
        }

        return $this;
    }

    public function removeCombat(Combat $combat): self
    {
        if ($this->combats->removeElement($combat)) {
            // set the owning side to null (unless already changed)
            if ($combat->getFirst() === $this) {
                $combat->setFirst(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Combat>
     */
    public function getCombatsExtra(): Collection
    {
        return $this->combats_extra;
    }

    public function addCombatsExtra(Combat $combatsExtra): self
    {
        if (!$this->combats_extra->contains($combatsExtra)) {
            $this->combats_extra[] = $combatsExtra;
            $combatsExtra->setSecond($this);
        }

        return $this;
    }

    public function removeCombatsExtra(Combat $combatsExtra): self
    {
        if ($this->combats_extra->removeElement($combatsExtra)) {
            // set the owning side to null (unless already changed)
            if ($combatsExtra->getSecond() === $this) {
                $combatsExtra->setSecond(null);
            }
        }

        return $this;
    }
}
