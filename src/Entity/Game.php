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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="game")
     */
    private $referee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competition", mappedBy="game")
     */
    private $competition;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stadium", mappedBy="game")
     */
    private $stade;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Season", mappedBy="game")
     */
    private $season;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Channel", inversedBy="games")
     */
    private $channel;


    public function __construct()
    {
        $this->team_home = new ArrayCollection();
        $this->team_away = new ArrayCollection();
        $this->referee = new ArrayCollection();
        $this->competition = new ArrayCollection();
        $this->stade = new ArrayCollection();
        $this->season = new ArrayCollection();
        $this->channel = new ArrayCollection();
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

    /**
     * @return Collection|Player[]
     */
    public function getReferee(): Collection
    {
        return $this->referee;
    }

    public function addReferee(Player $referee): self
    {
        if (!$this->referee->contains($referee)) {
            $this->referee[] = $referee;
            $referee->setGame($this);
        }

        return $this;
    }

    public function removeReferee(Player $referee): self
    {
        if ($this->referee->contains($referee)) {
            $this->referee->removeElement($referee);
            // set the owning side to null (unless already changed)
            if ($referee->getGame() === $this) {
                $referee->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competition[]
     */
    public function getCompetition(): Collection
    {
        return $this->competition;
    }

    public function addCompetition(Competition $competition): self
    {
        if (!$this->competition->contains($competition)) {
            $this->competition[] = $competition;
            $competition->setGame($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competition->contains($competition)) {
            $this->competition->removeElement($competition);
            // set the owning side to null (unless already changed)
            if ($competition->getGame() === $this) {
                $competition->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stadium[]
     */
    public function getStade(): Collection
    {
        return $this->stade;
    }

    public function addStade(Stadium $stade): self
    {
        if (!$this->stade->contains($stade)) {
            $this->stade[] = $stade;
            $stade->setGame($this);
        }

        return $this;
    }

    public function removeStade(Stadium $stade): self
    {
        if ($this->stade->contains($stade)) {
            $this->stade->removeElement($stade);
            // set the owning side to null (unless already changed)
            if ($stade->getGame() === $this) {
                $stade->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Season[]
     */
    public function getSeason(): Collection
    {
        return $this->season;
    }

    public function addSeason(Season $season): self
    {
        if (!$this->season->contains($season)) {
            $this->season[] = $season;
            $season->setGame($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): self
    {
        if ($this->season->contains($season)) {
            $this->season->removeElement($season);
            // set the owning side to null (unless already changed)
            if ($season->getGame() === $this) {
                $season->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Channel[]
     */
    public function getChannel(): Collection
    {
        return $this->channel;
    }

    public function addChannel(Channel $channel): self
    {
        if (!$this->channel->contains($channel)) {
            $this->channel[] = $channel;
        }

        return $this;
    }

    public function removeChannel(Channel $channel): self
    {
        if ($this->channel->contains($channel)) {
            $this->channel->removeElement($channel);
        }

        return $this;
    }
}
