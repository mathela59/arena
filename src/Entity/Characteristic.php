<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacteristicRepository")
 */
class Characteristic
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $ShortCode;

    /**
     * @ORM\Column(type="integer")
     */
    private $Minimum;

    /**
     * @ORM\Column(type="integer")
     */
    private $Maximum;

    public function __construct()
    {

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

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getShortCode(): ?string
    {
        return $this->ShortCode;
    }

    public function setShortCode(string $ShortCode): self
    {
        $this->ShortCode = $ShortCode;

        return $this;
    }


    public function getMinimum(): ?int
    {
        return $this->Minimum;
    }

    public function setMinimum(int $Minimum): self
    {
        $this->Minimum = $Minimum;

        return $this;
    }

    public function getMaximum(): ?int
    {
        return $this->Maximum;
    }

    public function setMaximum(int $Maximum): self
    {
        $this->Maximum = $Maximum;

        return $this;
    }
}
