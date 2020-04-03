<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WynikAlgUczelnieRepository")
 */
class WynikAlgUczelnie
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
    public $numer_dnia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $nazwa_zajec;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerDnia(): ?string
    {
        return $this->numer_dnia;
    }

    public function setNumerDnia(?string $numer_dnia): self
    {
        $this->numer_dnia = $numer_dnia;

        return $this;
    }

    public function getNazwaZajec(): ?string
    {
        return $this->nazwa_zajec;
    }

    public function setNazwaZajec(?string $nazwa_zajec): self
    {
        $this->nazwa_zajec = $nazwa_zajec;

        return $this;
    }
}
