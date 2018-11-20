<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 */
class Season
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, unique=true)
     */
    private $season_year;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SeasonCompetition", mappedBy="season")
     */
    private $seasonCompetitions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competition", mappedBy="season")
     */
    private $competitions;


    public function __construct()
    {
        $this->competition = new ArrayCollection();
        $this->seasonCompetitions = new ArrayCollection();
        $this->competitions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonYear(): ?string
    {
        return $this->season_year;
    }

    public function setSeasonYear(string $season_year): self
    {
        $this->season_year = $season_year;

        return $this;
    }

    /**
     * @return Collection|SeasonCompetition[]
     */
    public function getSeasonCompetitions(): Collection
    {
        return $this->seasonCompetitions;
    }

    public function addSeasonCompetition(SeasonCompetition $seasonCompetition): self
    {
        if (!$this->seasonCompetitions->contains($seasonCompetition)) {
            $this->seasonCompetitions[] = $seasonCompetition;
            $seasonCompetition->setSeason($this);
        }

        return $this;
    }

    public function removeSeasonCompetition(SeasonCompetition $seasonCompetition): self
    {
        if ($this->seasonCompetitions->contains($seasonCompetition)) {
            $this->seasonCompetitions->removeElement($seasonCompetition);
            // set the owning side to null (unless already changed)
            if ($seasonCompetition->getSeason() === $this) {
                $seasonCompetition->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competition[]
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): self
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions[] = $competition;
            $competition->setSeason($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competitions->contains($competition)) {
            $this->competitions->removeElement($competition);
            // set the owning side to null (unless already changed)
            if ($competition->getSeason() === $this) {
                $competition->setSeason(null);
            }
        }

        return $this;
    }
}
