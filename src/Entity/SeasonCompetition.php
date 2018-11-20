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
<<<<<<< HEAD
    private $competition;
=======
    private $name;
>>>>>>> refs/remotes/origin/master

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
<<<<<<< HEAD
    private $typeCompetition;
=======
    private $type;
>>>>>>> refs/remotes/origin/master

    /**
     * @ORM\Column(type="integer")
     */
<<<<<<< HEAD
    private $numberParticipate;
=======
    private $number_participate;
>>>>>>> refs/remotes/origin/master

    /**
     * @ORM\Column(type="integer")
     */
    private $locale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="seasonCompetitions")
     */
    private $season;

    /**
<<<<<<< HEAD
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="seasonCompetitions")
     */
    private $typeTeam;

=======
     * @ORM\Column(type="integer")
     */
    private $section;
>>>>>>> refs/remotes/origin/master

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?Competition
    {
<<<<<<< HEAD
        return $this->competition;
    }

    public function setName(?Competition $competition): self
    {
        $this->competition = $competition;
=======
        return $this->name;
    }

    public function setName(?Competition $name): self
    {
        $this->name = $name;
>>>>>>> refs/remotes/origin/master

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

<<<<<<< HEAD
    public function getTypeCompetition(): ?int
    {
        return $this->typeCompetition;
    }

    public function setTypeCompetition(int $typeCompetition): self
    {
        $this->typeCompetition = $typeCompetition;
=======
    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;
>>>>>>> refs/remotes/origin/master

        return $this;
    }

    public function getNumberParticipate(): ?int
    {
<<<<<<< HEAD
        return $this->numberParticipate;
    }

    public function setNumberParticipate(int $numberParticipate): self
    {
        $this->numberParticipate = $numberParticipate;
=======
        return $this->number_participate;
    }

    public function setNumberParticipate(int $number_participate): self
    {
        $this->number_participate = $number_participate;
>>>>>>> refs/remotes/origin/master

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

<<<<<<< HEAD
    public function getTypeTeam(): ?Team
    {
        return $this->typeTeam;
    }

    public function setTypeTeam(?Team $typeTeam): self
    {
        $this->typeTeam = $typeTeam;
=======
    public function getSection(): ?int
    {
        return $this->section;
    }

    public function setSection(int $section): self
    {
        $this->section = $section;
>>>>>>> refs/remotes/origin/master

        return $this;
    }
}
