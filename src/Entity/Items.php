<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemsRepository")
 */
class Items
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
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="text")
=======
     * @ORM\Column(type="json_array")
>>>>>>> 980071d6e757d15f2fc80e01ef107e1376f2f0f0
     */
    private $Modifiers = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Warrior", mappedBy="Items")
     */
    private $warriors;

    public function __construct()
    {
        $this->warriors = new ArrayCollection();
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

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getModifiers(): ?array
    {
        return $this->Modifiers;
    }

    public function setModifiers(array $Modifiers): self
    {
        $this->Modifiers = $Modifiers;

        return $this;
    }

    /**
     * @return Collection|Warrior[]
     */
    public function getWarriors(): Collection
    {
        return $this->warriors;
    }

    public function addWarrior(Warrior $warrior): self
    {
        if (!$this->warriors->contains($warrior)) {
            $this->warriors[] = $warrior;
            $warrior->addItem($this);
        }

        return $this;
    }

    public function removeWarrior(Warrior $warrior): self
    {
        if ($this->warriors->contains($warrior)) {
            $this->warriors->removeElement($warrior);
            $warrior->removeItem($this);
        }

        return $this;
    }
}
