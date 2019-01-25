<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StadiumRepository")
 */
class Stadium
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
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClubTeam", mappedBy="stadium")
     */
    private $clubTeams;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $capacity;

    public function __construct()
    {
        $this->clubTeams = new ArrayCollection();
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
            $clubTeam->setStadium($this);
        }

        return $this;
    }

    public function removeClubTeam(ClubTeam $clubTeam): self
    {
        if ($this->clubTeams->contains($clubTeam)) {
            $this->clubTeams->removeElement($clubTeam);
            // set the owning side to null (unless already changed)
            if ($clubTeam->getStadium() === $this) {
                $clubTeam->setStadium(null);
            }
        }

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }
}
