<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NauczycieleRepository")
 */
class Nauczyciele
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $przedmiot;

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

    public function getPrzedmiot(): ?string
    {
        return $this->przedmiot;
    }

    public function setPrzedmiot(?string $przedmiot): self
    {
        $this->przedmiot = $przedmiot;

        return $this;
    }
}
