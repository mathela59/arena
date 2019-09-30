<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WarriorCharacteristicRepository")
 */
class WarriorCharacteristic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warrior", inversedBy="warriorCharacteristics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Warrior;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Characteristic", inversedBy="warriorCharacteristics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Characteristic;

    /**
     * @ORM\Column(type="integer")
     */
    private $Value;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getCharacteristic(): ?Characteristic
    {
        return $this->Characteristic;
    }

    public function setCharacteristic(?Characteristic $Characteristic): self
    {
        $this->Characteristic = $Characteristic;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->Value;
    }

    public function setValue(int $Value): self
    {
        $this->Value = $Value;

        return $this;
    }
}
