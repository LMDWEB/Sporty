<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use App\Entity\Traits\PositionTraits;
use App\Entity\Traits\PublishedTraits;
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
    use TimestampableEntity;
    use PublishedTraits;
    use ArchivedTraits;
    use PositionTraits;

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
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     */
    private $user;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Assert\Type(type="\DateTime")
     */

    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Player", inversedBy="articles")
     */
    private $player;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Match", inversedBy="articles")
     */
    private $game = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="articles")
     */
    private $season = 0;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Thread", mappedBy="article")
     */
    private $threads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="article")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Poll", inversedBy="articles")
     */
    private $poll = 0;
    

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->player = new ArrayCollection();
        $this->threads = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getGame(): ?Match
    {
        return $this->game;
    }

    public function setGame(?Match $game): self
    {
        $this->game = $game;

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
     * @return Collection|Thread[]
     */
    public function getThreads(): Collection
    {
        return $this->threads;
    }

    public function addThread(Thread $thread): self
    {
        if (!$this->threads->contains($thread)) {
            $this->threads[] = $thread;
            $thread->addArticle($this);
        }

        return $this;
    }

    public function removeThread(Thread $thread): self
    {
        if ($this->threads->contains($thread)) {
            $this->threads->removeElement($thread);
            $thread->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    public function getPoll(): ?Poll
    {
        return $this->poll;
    }

    public function setPoll(?Poll $poll): self
    {
        $this->poll = $poll;

        return $this;
    }

}
