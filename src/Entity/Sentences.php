<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SentencesRepository")
 */
class Sentences
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FightingStyle", inversedBy="sentences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Style;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Races", inversedBy="sentences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Race;


    public function __construct()
    {
        $this->combats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getStyle(): ?FightingStyle
    {
        return $this->Style;
    }

    public function setStyle(?FightingStyle $Style): self
    {
        $this->Style = $Style;

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



}
