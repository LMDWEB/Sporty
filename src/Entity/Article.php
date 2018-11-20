<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use App\Entity\Traits\PublishedTraits;
use App\Entity\Traits\TimestampableTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Article
 *
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    use TimestampableTraits;
    use PublishedTraits;
    use ArchivedTraits;

    /**
	 * @var integer
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     * @ORM\Id
     */
	private $id;

    /**
	 * @var string
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank(message="Veuillez choisir un titre !")
     */
	private $title;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title", "id"})
     * @ORM\Column(length=128, unique=true, nullable=true)
     */
    private $slug = null;

    /**
	 * @var string
     * @ORM\Column(type="text")
     */
	private $content = "";

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Assert\Type(type="\DateTime")
     */
    private $date;

    /**
     * @Assert\Image(
     *     allowLandscape = false,
     *     allowPortrait = false
     * )
     */
    protected $photo;
    /**
     * @var string
     *
     * @ORM\Column(name="namephoto", type="string", length=100, nullable=true)
     */
    protected $namePhoto;

    /**
     * @ORM\Column(type="boolean")
     */
    private $featured;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $views;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $source_article;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $source_image;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $resume;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="category")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Player", inversedBy="articles")
     */
    private $player;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Thread", inversedBy="articles")
     */
    private $thread;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ClubTeam", inversedBy="articles")
     */
    private $club;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Game", inversedBy="articles")
     */
    private $game;

    public function __construct()
    {
        $this->player = new ArrayCollection();
        $this->thread = new ArrayCollection();
        $this->club = new ArrayCollection();
        $this->game = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle():? string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Article
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return Article
     */
    public function setSlug(string $slug):? self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Article
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getFeatured(): ?bool
    {
        return $this->featured;
    }

    public function setFeatured(bool $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

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

    public function getSourceArticle(): ?string
    {
        return $this->source_article;
    }

    public function setSourceArticle(?string $source_article): self
    {
        $this->source_article = $source_article;

        return $this;
    }

    public function getSourceImage(): ?string
    {
        return $this->source_image;
    }

    public function setSourceImage(?string $source_image): self
    {
        $this->source_image = $source_image;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player[] = $player;
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->player->contains($player)) {
            $this->player->removeElement($player);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string
     */
    public function getNamePhoto()
    {
        return $this->namePhoto;
    }

    /**
     * @param string $namePhoto
     */
    public function setNamePhoto(string $namePhoto)
    {
        $this->namePhoto = $namePhoto;

        return $this;
    }

    /**
     * @return Collection|Thread[]
     */
    public function getThread(): Collection
    {
        return $this->thread;
    }

    public function addThread(Thread $thread): self
    {
        if (!$this->thread->contains($thread)) {
            $this->thread[] = $thread;
        }

        return $this;
    }

    public function removeThread(Thread $thread): self
    {
        if ($this->thread->contains($thread)) {
            $this->thread->removeElement($thread);
        }

        return $this;
    }

    /**
     * @return Collection|ClubTeam[]
     */
    public function getClub(): Collection
    {
        return $this->club;
    }

    public function addClub(ClubTeam $club): self
    {
        if (!$this->club->contains($club)) {
            $this->club[] = $club;
        }

        return $this;
    }

    public function removeClub(ClubTeam $club): self
    {
        if ($this->club->contains($club)) {
            $this->club->removeElement($club);
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGame(): Collection
    {
        return $this->game;
    }

    public function addGame(Game $game): self
    {
        if (!$this->game->contains($game)) {
            $this->game[] = $game;
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->game->contains($game)) {
            $this->game->removeElement($game);
        }

        return $this;
    }
}
