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

    #[ORM\ManyToOne(targetEntity: FightStyle::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $FightStyle;

    #[ORM\ManyToOne(targetEntity: Breed::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $breed;

    #[ORM\ManyToMany(targetEntity: Skills::class)]
    private $skills;

    #[ORM\Column(type: 'integer')]
    private $Experience;

    #[ORM\ManyToMany(targetEntity: Traits::class)]
    private $Traits;

    #[ORM\ManyToMany(targetEntity: Slots::class)]
    private $Slots;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->Traits = new ArrayCollection();
        $this->Slots = new ArrayCollection();
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
}
