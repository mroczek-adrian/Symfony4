<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeachersRepository")
 */
class Teachers
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $day1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $day2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $day3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getDay1(): ?int
    {
        return $this->day1;
    }

    public function setDay1(?int $day1): self
    {
        $this->day1 = $day1;

        return $this;
    }

    public function getDay2(): ?int
    {
        return $this->day2;
    }

    public function setDay2(?int $day2): self
    {
        $this->day2 = $day2;

        return $this;
    }

    public function getDay3(): ?int
    {
        return $this->day3;
    }

    public function setDay3(?int $day3): self
    {
        $this->day3 = $day3;

        return $this;
    }
}
