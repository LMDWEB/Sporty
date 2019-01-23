<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use App\Entity\Traits\PublishedTraits;
use App\Entity\Traits\TimestampableTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 * @Vich\Uploadable
 */
class Player
{

    use TimestampableTraits;
    use PublishedTraits;
    use ArchivedTraits;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
    * @Vich\UploadableField(mapping="player_image", fileNameProperty="imageName")
    *
    * @var File
    */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $firstname;

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
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $surname;

    /**
     * @var string
     * @Gedmo\Slug(fields={"firstname", "lastname", "id"})
     * @ORM\Column(length=50, unique=true, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="player")
     */
    private $articles;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlayerMercato", mappedBy="player")
     */
    private $playerMercatos;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Game", mappedBy="players")
     */
    private $games;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->playerMercatos = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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
  
    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
            $playerMercato->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerMercato(PlayerMercato $playerMercato): self
    {
        if ($this->playerMercatos->contains($playerMercato)) {
            $this->playerMercatos->removeElement($playerMercato);
            // set the owning side to null (unless already changed)
            if ($playerMercato->getPlayer() === $this) {
                $playerMercato->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     * @return $this
     */
    public function setImageFile(File $imageFile)
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            // En gros, y a un bug sur vich, quand on modifie juste l'image, Symfony ne detecte aucun changement
            // Et ca persist pas l'image en base, du coup petite technique, des qu'on modifie une image, on modifie l'updateAt
            // Et comme ca l'image s'enregistre en base !
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getImageName(): string
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     * @return $this
     */
    public function setImageName(string $imageName)
    {
        $this->imageName = $imageName;
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
            $game->addPlayer($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->contains($game)) {
            $this->games->removeElement($game);
            $game->removePlayer($this);
        }

        return $this;
    }
}
