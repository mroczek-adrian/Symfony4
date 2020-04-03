<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GodzinyPracyUczelniRepository")
 */
class GodzinyPracyUczelni
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dzien;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $godziny;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDzien(): ?int
    {
        return $this->dzien;
    }

    public function setDzien(?int $dzien): self
    {
        $this->dzien = $dzien;

        return $this;
    }

    public function getGodziny(): ?int
    {
        return $this->godziny;
    }

    public function setGodziny(?int $godziny): self
    {
        $this->godziny = $godziny;

        return $this;
    }
}
