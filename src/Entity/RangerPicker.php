<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RangerPickerRepository")
 */
class RangerPicker
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $startDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $endDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?int
    {
        return $this->startDate;
    }

    public function setStartDate(int $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?int
    {
        return $this->endDate;
    }

    public function setEndDate(int $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function toArray(): Array
    {
        return array($this->getStartDate(), $this->getEndDate());
    }
}
