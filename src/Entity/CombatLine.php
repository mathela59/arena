<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CombatLineRepository")
 */
class CombatLine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Combat", inversedBy="combatLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Combat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warrior")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Attacker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warrior")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Defender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sentences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Sentence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCombat(): ?Combat
    {
        return $this->Combat;
    }

    public function setCombat(?Combat $Combat): self
    {
        $this->Combat = $Combat;

        return $this;
    }

    public function getAttacker(): ?Warrior
    {
        return $this->Attacker;
    }

    public function setAttacker(?Warrior $Attacker): self
    {
        $this->Attacker = $Attacker;

        return $this;
    }

    public function getDefender(): ?Warrior
    {
        return $this->Defender;
    }

    public function setDefender(?Warrior $Defender): self
    {
        $this->Defender = $Defender;

        return $this;
    }

    public function getSentence(): ?Sentences
    {
        return $this->Sentence;
    }

    public function setSentence(?Sentences $Sentence): self
    {
        $this->Sentence = $Sentence;

        return $this;
    }
}
