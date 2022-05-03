<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Slots::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $slot;

    #[ORM\ManyToOne(targetEntity: Warrior::class, inversedBy: 'equipment')]
    private $Warrior;

    #[ORM\ManyToOne(targetEntity: Items::class, inversedBy: 'equipment')]
    #[ORM\JoinColumn(nullable: false)]
    private $item;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlot(): ?Slots
    {
        return $this->slot;
    }

    public function setSlot(?Slots $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    public function getWarrior(): ?Warrior
    {
        return $this->Warrior;
    }

    public function setWarrior(?Warrior $Warrior): self
    {
        $this->Warrior = $Warrior;

        return $this;
    }

    public function getItem(): ?Items
    {
        return $this->item;
    }

    public function setItem(?Items $item): self
    {
        $this->item = $item;

        return $this;
    }
}
