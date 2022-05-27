<?php

namespace App\Entity;

use App\Repository\CombatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombatRepository::class)]
class Combat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Warrior::class, inversedBy: 'combats')]
    #[ORM\JoinColumn(nullable: false)]
    private $first;

    #[ORM\ManyToOne(targetEntity: Warrior::class, inversedBy: 'combats_extra')]
    #[ORM\JoinColumn(nullable: false)]
    private $Second;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\OneToMany(mappedBy: 'Combat', targetEntity: CombatLines::class,
        orphanRemoval: true, cascade: ['persist'])]
    private $combatLines;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $winner;

    public function __construct()
    {
        $this->combatLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirst(): ?Warrior
    {
        return $this->first;
    }

    public function setFirst(?Warrior $first): self
    {
        $this->first = $first;

        return $this;
    }

    public function getSecond(): ?Warrior
    {
        return $this->Second;
    }

    public function setSecond(?Warrior $Second): self
    {
        $this->Second = $Second;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, CombatLines>
     */
    public function getCombatLines(): Collection
    {
        return $this->combatLines;
    }

    public function addCombatLine(CombatLines $combatLine): self
    {
            $this->combatLines[] = $combatLine;
            $combatLine->setCombat($this);

        return $this;
    }

    public function addCombatLines(array $combatLines): self
    {
        foreach($combatLines as $combatLine) {
            $this->combatLines[] = $combatLine;
            $combatLine->setCombat($this);
        }
        return $this;
    }

    public function removeCombatLine(CombatLines $combatLine): self
    {
        if ($this->combatLines->removeElement($combatLine)) {
            // set the owning side to null (unless already changed)
            if ($combatLine->getCombat() === $this) {
                $combatLine->setCombat(null);
            }
        }

        return $this;
    }

    public function getWinner(): ?int
    {
        return $this->winner;
    }

    public function setWinner(?int $winner): self
    {
        $this->winner = $winner;

        return $this;
    }
}
