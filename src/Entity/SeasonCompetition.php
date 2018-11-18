<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonCompetitionRepository")
 */
class SeasonCompetition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="image")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_participate;

    /**
     * @ORM\Column(type="integer")
     */
    private $locale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="seasonCompetitions")
     */
    private $season;

    /**
     * @ORM\Column(type="integer")
     */
    private $section;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?Competition
    {
        return $this->name;
    }

    public function setName(?Competition $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNumberParticipate(): ?int
    {
        return $this->number_participate;
    }

    public function setNumberParticipate(int $number_participate): self
    {
        $this->number_participate = $number_participate;

        return $this;
    }

    public function getLocale(): ?int
    {
        return $this->locale;
    }

    public function setLocale(int $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getSection(): ?int
    {
        return $this->section;
    }

    public function setSection(int $section): self
    {
        $this->section = $section;

        return $this;
    }
}
