<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UczelnieRepository")
 */
class Uczelnie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @var string
     *
     * @ORM\Column(name="nazwa",type="string", length=255, nullable=true)
     */
    private $nazwa;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set name
     *
     * @param string $nazwa
     * @return Uczelnie
     */
    public function setName($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

}
