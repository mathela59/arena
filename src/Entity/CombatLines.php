<?php

namespace App\Entity;

use App\Repository\CombatLinesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombatLinesRepository::class)]
class CombatLines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $text;

    #[ORM\ManyToOne(targetEntity: Combat::class, inversedBy: 'combatLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $Combat;

    #[ORM\Column(type: 'integer')]
    private $sortingKey;

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

    public function getCombat(): ?Combat
    {
        return $this->Combat;
    }

    public function setCombat(?Combat $Combat): self
    {
        $this->Combat = $Combat;

        return $this;
    }

    public function getSortingKey(): ?int
    {
        return $this->sortingKey;
    }

    public function setSortingKey(int $sortingKey): self
    {
        $this->sortingKey = $sortingKey;

        return $this;
    }
}
