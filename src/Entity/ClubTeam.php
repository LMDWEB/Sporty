<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ClubTeamRepository")
 * @UniqueEntity(
 *     fields={"club", "team"},
 *     errorPath="team",
 *     message="This team is already in use on that club."
 * )
 */

class ClubTeam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;


    /**
     * @ORM\Column(type="integer")
     */
    private $year_creation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="clubTeams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="clubTeams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="club")
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stadium", inversedBy="clubTeams")
     */
    private $stadium;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Game", mappedBy="team_home")
     */
    private $games;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competition", mappedBy="teams")
     */
    private $competitions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlayerMercato", mappedBy="team")
     */
    private $playerMercatos;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SeasonCompetition", mappedBy="teams")
     */
    private $seasonCompetitions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="participants")
     */
    private $events;

    /**
     * @var string
     * @Gedmo\Slug(fields={"name", "id"})
     * @ORM\Column(length=128, unique=true, nullable=true)
     */
    private $slug = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlayerMercato", mappedBy="oldTeam")
     */
    private $oldPlayerMercato;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->competitions = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->playerMercatos = new ArrayCollection();
        $this->seasonCompetitions = new ArrayCollection();
        $this->oldPlayerMercato = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYearCreation(): ?int
    {
        return $this->year_creation;
    }

    public function setYearCreation(int $year_creation): self
    {
        $this->year_creation = $year_creation;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
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
            $article->addClub($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->removeClub($this);
        }

        return $this;
    }

    public function getStadium(): ?Stadium
    {
        return $this->stadium;
    }

    public function setStadium(?Stadium $stadium): self
    {
        $this->stadium = $stadium;

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

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setTeamHome($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->contains($game)) {
            $this->games->removeElement($game);
            // set the owning side to null (unless already changed)
            if ($game->getTeamHome() === $this) {
                $game->setTeamHome(null);
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
            $competition->addTeam($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competitions->contains($competition)) {
            $this->competitions->removeElement($competition);
            $competition->removeTeam($this);
        }

        return $this;
    }

    /**
     * @return Collection|PlayerMercato[]
     */
    public function getPlayerMercatos(): Collection
    {
        return $this->playerMercatos;
    }

    public function addPlayerMercato(PlayerMercato $playerMercato): self
    {
        if (!$this->playerMercatos->contains($playerMercato)) {
            $this->playerMercatos[] = $playerMercato;
            $playerMercato->setTeam($this);
        }

        return $this;
    }

    public function removePlayerMercato(PlayerMercato $playerMercato): self
    {
        if ($this->playerMercatos->contains($playerMercato)) {
            $this->playerMercatos->removeElement($playerMercato);
            // set the owning side to null (unless already changed)
            if ($playerMercato->getTeam() === $this) {
                $playerMercato->setTeam(null);
            }
        }

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
            $seasonCompetition->addTeam($this);
        }
    }

    public function removeSeasonCompetition(SeasonCompetition $seasonCompetition): self
    {
        if ($this->seasonCompetitions->contains($seasonCompetition)) {
            $this->seasonCompetitions->removeElement($seasonCompetition);
            $seasonCompetition->removeTeam($this);

        }
    }

    /**
     * @return Collection|Event[]
     */

    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addParticipant($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeParticipant($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|PlayerMercato[]
     */
    public function getOldPlayerMercato(): Collection
    {
        return $this->oldPlayerMercato;
    }

    public function addOldPlayerMercato(PlayerMercato $oldPlayerMercato): self
    {
        if (!$this->oldPlayerMercato->contains($oldPlayerMercato)) {
            $this->oldPlayerMercato[] = $oldPlayerMercato;
            $oldPlayerMercato->setOldTeam($this);
        }

        return $this;
    }

    public function removeOldPlayerMercato(PlayerMercato $oldPlayerMercato): self
    {
        if ($this->oldPlayerMercato->contains($oldPlayerMercato)) {
            $this->oldPlayerMercato->removeElement($oldPlayerMercato);
            // set the owning side to null (unless already changed)
            if ($oldPlayerMercato->getOldTeam() === $this) {
                $oldPlayerMercato->setOldTeam(null);
            }
        }

        return $this;
    }
}