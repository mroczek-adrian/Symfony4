<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KtoryAlgZastosowacRepository")
 */
class KtoryAlgZastosowac
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
    private $nazwa_algorytmu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwaAlgorytmu(): ?string
    {
        return $this->nazwa_algorytmu;
    }

    public function setNazwaAlgorytmu(?string $nazwa_algorytmu): self
    {
        $this->nazwa_algorytmu = $nazwa_algorytmu;

        return $this;
    }
}
