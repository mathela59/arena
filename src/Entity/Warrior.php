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
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $description;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'warriors')]
    #[ORM\JoinColumn(nullable: true)]
    private  $Coach;

    #[ORM\ManyToOne(targetEntity: FightStyle::class)]
    #[ORM\JoinColumn(nullable: false)]
    private  $FightStyle;

    #[ORM\Column(type: 'integer')]
    private int $Experience;

    #[ORM\ManyToOne(targetEntity: Breed::class)]
    #[ORM\JoinColumn(nullable: false)]
    private  $Breed;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $Strength;

    #[ORM\Column(type: 'integer')]
    private int $Speed;

    #[ORM\Column(type: 'integer')]
    private int $Dexterity;

    #[ORM\Column(type: 'integer')]
    private int $Constitution;

    #[ORM\Column(type: 'integer')]
    private int $Intelligence;

    #[ORM\Column(type: 'integer')]
    private int $Will;

    #[ORM\OneToMany(mappedBy: 'Warrior', targetEntity: Equipment::class)]
    private $equipment;

    #[ORM\OneToMany(mappedBy: 'first', targetEntity: Combat::class)]
    private $combats;

    #[ORM\OneToMany(mappedBy: 'Second', targetEntity: Combat::class)]
    private $combats_extra;

    private array $ratios;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->equipment = new ArrayCollection();
        $this->combats = new ArrayCollection();
        $this->combats_extra = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
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
        return $this->Breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->Breed = $breed;

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

    /**
     * @param Equipment $equipment
     * @return $this
     */
    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment[] = $equipment;
            $equipment->setWarrior($this);
        }

        return $this;
    }

    /**
     * @param Equipment $equipment
     * @return $this
     */
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

    /**
     * @param Combat $combat
     * @return $this
     */
    public function addCombat(Combat $combat): self
    {
        if (!$this->combats->contains($combat)) {
            $this->combats[] = $combat;
            $combat->setFirst($this);
        }

        return $this;
    }

    /**
     * @param Combat $combat
     * @return $this
     */
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

    /**
     * @param Combat $combatsExtra
     * @return $this
     */
    public function addCombatsExtra(Combat $combatsExtra): self
    {
        if (!$this->combats_extra->contains($combatsExtra)) {
            $this->combats_extra[] = $combatsExtra;
            $combatsExtra->setSecond($this);
        }

        return $this;
    }

    /**
     * @param Combat $combatsExtra
     * @return $this
     */
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

    /**
     * @return array
     */
    public function getRatios(): array
    {
        return $this->ratios;
    }

    /**
     * @param array $ratios
     */
    public function setRatios(array $ratios): void
    {
        $this->ratios = $ratios;
    }

    /**
     * @param string $key
     * @return float
     */
    public function getOneRatio(string $key): float
    {
        return $this->ratios[$key];
    }

    /**
     * @param string $key
     * @param float $value
     * @return void
     */
    public function setOneRatio(string $key, float $value): void
    {
        $this->ratios[$key]=$value;
    }
}
