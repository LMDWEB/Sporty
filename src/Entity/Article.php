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
     * @var Tag
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="articles", cascade={"persist"})
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->player = new ArrayCollection();
    }

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
     * @param Tag $tag
     *
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
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

}
