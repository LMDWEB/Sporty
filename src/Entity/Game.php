<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $matchday;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Club", mappedBy="game")
     */
    private $team_home;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Club", mappedBy="game")
     */
    private $team_away;

    public function __construct()
    {
        $this->team_home = new ArrayCollection();
        $this->team_away = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchday(): ?string
    {
        return $this->matchday;
    }

    public function setMatchday(string $matchday): self
    {
        $this->matchday = $matchday;

        return $this;
    }

    /**
     * @return Collection|Club[]
     */
    public function getTeamHome(): Collection
    {
        return $this->team_home;
    }

    public function addTeamHome(Club $teamHome): self
    {
        if (!$this->team_home->contains($teamHome)) {
            $this->team_home[] = $teamHome;
            $teamHome->setGame($this);
        }

        return $this;
    }

    public function removeTeamHome(Club $teamHome): self
    {
        if ($this->team_home->contains($teamHome)) {
            $this->team_home->removeElement($teamHome);
            // set the owning side to null (unless already changed)
            if ($teamHome->getGame() === $this) {
                $teamHome->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Club[]
     */
    public function getTeamAway(): Collection
    {
        return $this->team_away;
    }

    public function addTeamAway(Club $teamAway): self
    {
        if (!$this->team_away->contains($teamAway)) {
            $this->team_away[] = $teamAway;
            $teamAway->setGame($this);
        }

        return $this;
    }

    public function removeTeamAway(Club $teamAway): self
    {
        if ($this->team_away->contains($teamAway)) {
            $this->team_away->removeElement($teamAway);
            // set the owning side to null (unless already changed)
            if ($teamAway->getGame() === $this) {
                $teamAway->setGame(null);
            }
        }

        return $this;
    }
}
