<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @UniqueEntity(
 *     fields={"team_home", "team_away"},
 *     errorPath="team_away",
 *     message="This team home is already in use on that team away."
 * )
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
     * @ORM\Column(type="integer", length=11)
     */
    private $matchday;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClubTeam", inversedBy="games")
     */
    private $team_home;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClubTeam", inversedBy="games")
     */
    private $team_away;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="player")
     */
    private $referee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="competition")
     */
    private $competition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stadium", inversedBy="stadium")
     */
    private $stade;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="season")
     */
    private $season;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Channel", inversedBy="games")
     */
    private $channel;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="game")
     */
    private $articles;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;


    public function __construct()
    {
        $this->channel = new ArrayCollection();
        $this->articles = new ArrayCollection();
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

    public function getTeamHome(): ?ClubTeam
    {
        return $this->team_home;
    }

    public function setTeamHome(?ClubTeam $team): self
    {
        $this->team_home = $team;

        return $this;
    }

    public function getTeamAway(): ?ClubTeam
    {
        return $this->team_away;
    }

    public function setTeamAway(?ClubTeam $team): self
    {
        $this->team_away = $team;

        return $this;
    }

    public function getReferee(): ?Player
    {
        return $this->referee;
    }

    public function setReferee(?Player $player): self
    {
        $this->referee = $player;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    public function getStadium(): ?Stadium
    {
        return $this->stade;
    }

    public function setStadium(?Stadium $stade): self
    {
        $this->stade = $stade;

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

    public function listMatchDay()
    {
        $matchday = array();

        for ($i = 1; $i <= 50; $i++) {
            if ($i != 1) {
                $matchday[$i . "ème journée"] = $i ;
            } else {
                $matchday[$i . "ère journée"] = $i ;
            }
        }

        $matchday['64ème de finale'] = 51;
        $matchday['32ème de finale'] = 52;
        $matchday['16ème de finale'] = 53;
        $matchday['8ème de finale'] = 54;
        $matchday['Quart de finale'] = 55;
        $matchday['Demi finale'] = 56;
        $matchday['Finale'] = 57;

        return $matchday;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addGame($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->removeGame($this);
        }

        return $this;
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
}
