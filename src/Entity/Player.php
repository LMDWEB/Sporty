<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use App\Entity\Traits\PublishedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{

    use TimestampableEntity;
    use PublishedTraits;
    use ArchivedTraits;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date")
     */
    private $dateBirth;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $city_birth;

    /**
     * @ORM\Column(type="integer")
     */
    private $foot;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $nationality;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="player")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDateBirth(): ?\DateTimeInterface
    {
        return $this->dateBirth;
    }

    public function setDateBirth(\DateTimeInterface $dateBirth): self
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    public function getCityBirth(): ?string
    {
        return $this->city_birth;
    }

    public function setCityBirth(?string $city_birth): self
    {
        $this->city_birth = $city_birth;

        return $this;
    }

    public function getFoot(): ?int
    {
        return $this->foot;
    }

    public function setFoot(int $foot): self
    {
        $this->foot = $foot;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

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
            $article->addPlayer($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->removePlayer($this);
        }

        return $this;
    }
}
