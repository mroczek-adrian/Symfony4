<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZajeciaRepository")
 */
class Zajecia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nazwa;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $okres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(?string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getOkres(): ?int
    {
        return $this->okres;
    }

    public function setOkres(?int $okres): self
    {
        $this->okres = $okres;

        return $this;
    }
}
