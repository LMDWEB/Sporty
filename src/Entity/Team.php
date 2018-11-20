<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 * @UniqueEntity(
 *     fields={"name", "section"},
 *     errorPath="section",
 *     message="This section is already in use on that team."
 * )
 */
class Team
{
    use TimestampableEntity;
    use ArchivedTraits;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClubTeam", mappedBy="team")
     */
    private $clubTeams;

    /**
     * @ORM\Column(type="integer")
     */
    private $section;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SeasonCompetition", mappedBy="typeTeam")
     */
    private $seasonCompetitions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competition", mappedBy="section")
     */
    private $competitions;

    public function __construct()
    {
        $this->clubTeams = new ArrayCollection();
        $this->seasonCompetitions = new ArrayCollection();
        $this->competitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ClubTeam[]
     */
    public function getClubTeams(): Collection
    {
        return $this->clubTeams;
    }

    public function addClubTeam(ClubTeam $clubTeam): self
    {
        if (!$this->clubTeams->contains($clubTeam)) {
            $this->clubTeams[] = $clubTeam;
            $clubTeam->setTeam($this);
        }

        return $this;
    }

    public function removeClubTeam(ClubTeam $clubTeam): self
    {
        if ($this->clubTeams->contains($clubTeam)) {
            $this->clubTeams->removeElement($clubTeam);
            // set the owning side to null (unless already changed)
            if ($clubTeam->getTeam() === $this) {
                $clubTeam->setTeam(null);
            }
        }

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

    public function getNameSection()
    {
        if ($this->section == 0){
            $section = "Homme";
        } elseif($this->section == 1) {
            $section = "Femme";
        }

        return $section;
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
            $seasonCompetition->setTypeTeam($this);
        }

        return $this;
    }

    public function removeSeasonCompetition(SeasonCompetition $seasonCompetition): self
    {
        if ($this->seasonCompetitions->contains($seasonCompetition)) {
            $this->seasonCompetitions->removeElement($seasonCompetition);
            // set the owning side to null (unless already changed)
            if ($seasonCompetition->getTypeTeam() === $this) {
                $seasonCompetition->setTypeTeam(null);
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
            $competition->setSection($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competitions->contains($competition)) {
            $this->competitions->removeElement($competition);
            // set the owning side to null (unless already changed)
            if ($competition->getSection() === $this) {
                $competition->setSection(null);
            }
        }

        return $this;
    }
}
