<?php

namespace App\Entity;

use App\Repository\FightStyleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FightStyleRepository::class)]
class FightStyle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'json', nullable: true)]
    private $modifiers = [];

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

    public function getModifiers(): ?array
    {
        return $this->modifiers;
    }

    public function setModifiers(?array $modifiers): self
    {
        $this->modifiers = $modifiers;

        return $this;
    }
}
