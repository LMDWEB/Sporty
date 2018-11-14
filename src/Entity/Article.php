<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Club", inversedBy="articles")
     */
    private $club;

    public function __construct()
    {
        $this->club = new ArrayCollection();
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

    /**
     * @return Collection|Club[]
     */
    public function getIdClub(): Collection
    {
        return $this->club;
    }

    public function addIdClub(Club $idClub): self
    {
        if (!$this->club->contains($idClub)) {
            $this->club[] = $idClub;
        }

        return $this;
    }

    public function removeIdClub(Club $idClub): self
    {
        if ($this->club->contains($idClub)) {
            $this->club->removeElement($idClub);
        }

        return $this;
    }
}
