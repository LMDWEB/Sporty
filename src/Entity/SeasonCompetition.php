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
    private $competition;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $typeCompetition;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberParticipate;

    /**
     * @ORM\Column(type="integer")
     */
    private $locale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="seasonCompetitions")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="seasonCompetitions")
     */
    private $typeTeam;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?Competition
    {
        return $this->competition;
    }

    public function setName(?Competition $competition): self
    {
        $this->competition = $competition;

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

    public function getTypeCompetition(): ?int
    {
        return $this->typeCompetition;
    }

    public function setTypeCompetition(int $typeCompetition): self
    {
        $this->typeCompetition = $typeCompetition;

        return $this;
    }

    public function getNumberParticipate(): ?int
    {
        return $this->numberParticipate;
    }

    public function setNumberParticipate(int $numberParticipate): self
    {
        $this->numberParticipate = $numberParticipate;

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

    public function getTypeTeam(): ?Team
    {
        return $this->typeTeam;
    }

    public function setTypeTeam(?Team $typeTeam): self
    {
        $this->typeTeam = $typeTeam;

        return $this;
    }
}
