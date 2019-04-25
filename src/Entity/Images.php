<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 */
class Images
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

      /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $det_1;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $det_2;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $det_3;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $det_4;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDet1(): ?string
    {
        return $this->det_1;
    }

    public function setDet1(?string $det_1): self
    {
        $this->det_1 = $det_1;

        return $this;
    }

    public function getDet2(): ?string
    {
        return $this->det_2;
    }

    public function setDet2(?string $det_2): self
    {
        $this->det_2 = $det_2;

        return $this;
    }

    public function getDet3(): ?string
    {
        return $this->det_3;
    }

    public function setDet3(?string $det_3): self
    {
        $this->det_3 = $det_3;

        return $this;
    }

    public function getDet4(): ?string
    {
        return $this->det_4;
    }

    public function setDet4(string $det_4): self
    {
        $this->det_4 = $det_4;

        return $this;
    }
}
