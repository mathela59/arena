<?php

namespace App\Entity;

use App\Repository\SentenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SentenceRepository::class)]
class Sentence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $text;

    #[ORM\Column(type: 'string', length: 255)]
    private $action;

    #[ORM\ManyToOne(targetEntity: FightStyle::class)]
    private $fightStyle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getFightStyle(): ?FightStyle
    {
        return $this->fightStyle;
    }

    public function setFightStyle(?FightStyle $fightStyle): self
    {
        $this->fightStyle = $fightStyle;

        return $this;
    }
}
